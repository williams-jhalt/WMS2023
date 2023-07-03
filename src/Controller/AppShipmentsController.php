<?php

namespace App\Controller;

use App\Repository\PickerLogRepository;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class AppShipmentsController extends AbstractController
{
    #[Route('/shipments/', name: 'shipments_index')]
    public function index(): Response
    {
        return $this->render('shipments/index.html.twig');
    }

    #[Route('/shipments/list', name: 'shipments_list', options: ['expose' => true])]
    public function listAction(OrderService $service, PickerLogRepository $docRepo, Request $request): JsonResponse {
        
        $cache = new FilesystemAdapter('wms', 3000);

        $isPacked = $request->get('is_packed');
        $isPicked = $request->get('is_picked');
        $isShipped = $request->get('is_shipped');
        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $search = $request->get('search');
        $order = (array) $request->get('order', []);

        $resultData = $cache->get('openShipments', function() use ($service, $docRepo) {
                
            $openShipments = $service->findOpenShipments();

            $resultData = [];

            foreach ($openShipments as $shipment) {

                $picker = $docRepo->findOneByOrderNumber($shipment->getManifestId());
                $cartons = $service->getCartons($shipment->getOrderNumber());

                $cartonCount = count($cartons);

                $trackingNumbers = "";

                if ($cartonCount > 0) {
                    for ($i = 0; $i < $cartonCount; $i++) {
                        if (!empty($cartons[$i]->getTrackingNumber())) {
                            $trackingNumbers .= $cartons[$i]->getTrackingNumber();
                            if ($i < $cartonCount - 1) {
                                $trackingNumbers .= ", ";
                            }
                        }
                    }
                }

                $resultData[] = [
                    $shipment->getManifestId(),
                    $shipment->getWebReferenceNumber(),
                    $shipment->getOrderDate()->format('Y-m-d'),
                    $picker == null ? "Not Picked" : $picker->getUser(),
                    $cartonCount > 0 ? "{$cartonCount} Cartons Packed" : "Not Packed",
                    empty($trackingNumbers) ? "Not Shipped" : $trackingNumbers
                ];
            }        

            return $resultData;
        });

        $filtered = [];

        foreach ($resultData as $item) {
            if (!empty($search['value']) && !preg_match("/.*{$search['value']}.*/", $item[0]) && !preg_match("/.*{$search['value']}.*/", $item[1])) {
                continue;
            }
            if ($isShipped == 'true' && $item[5] == "Not Shipped") {
                continue;
            }
            if ($isPacked == 'true' && $item[4] == "Not Packed") {
                continue;
            }
            if ($isPicked == 'true' && $item[3] == "Not Picked") {
                continue;
            }
            $filtered[] = $item;
        }

        foreach ($order as $o) {
            usort($filtered, function($a, $b) use ($o) {
                if ($a[$o['column']] == $b[$o['column']]) {
                    return 0;
                }
                if ($o['dir'] == 'desc') {
                    return ($a[$o['column']] > $b[$o['column']]) ? -1 : 1;
                } else {
                    return ($a[$o['column']] < $b[$o['column']]) ? -1 : 1;
                }
            });
        }

        $data = [
            'draw' => $draw,
            'recordsTotal' => count($resultData),
            'recordsFiltered' => count($filtered),
            'data' => array_slice($filtered, $start, $length)
        ];

        return $this->json($data);
    }
}
