<?php

namespace App\Controller;

use App\Service\ErpService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppPackerLogController extends AbstractController
{
    #[Route('/packer-log', name: 'packer_log_index')]
    public function index(Request $request, ErpService $erp): Response
    {

        $defaultEndDate = new \DateTimeImmutable("yesterday");
        $defaultStartDate = $defaultEndDate->sub(new \DateInterval("P1D"));

        $startDate = $request->get('startDate', $defaultStartDate->format('m/d/Y'));
        $endDate = $request->get('endDate', $defaultEndDate->format('m/d/Y'));

        $repo = $erp->getPackerLogEntryRepository();

        $limit = 100;
        $offset = 0;

        $data = [];

        do {

            $entries = $repo->findByStartDateAndEndDate(new \DateTime($startDate), new \DateTime($endDate), $limit, $offset);

            foreach ($entries->getPackerLogEntries() as $entry) {
                $userId = strtoupper($entry->getUserId());
                if (!isset($data[$userId])) {
                    $data[$userId] = [];
                }
                if (isset($data[$userId][$entry->getUcc()])) {
                    $data[$userId][(string) $entry->getUcc()] += $entry->getQtyShipped();
                } else {
                    $data[$userId][(string) $entry->getUcc()] = $entry->getQtyShipped();
                }
            }

            $offset = $offset + $limit;
        } while (sizeof($entries->getPackerLogEntries()) > 0);

        $result = [];

        foreach ($data as $userId => $t) {
            $result[] = [
                'userId' => $userId,
                'totalPackages' => count($t),
                'totalItems' => array_sum($t)
            ];
        }

        return $this->render('packer-log/index.html.twig', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'packerData' => $result
        ]);
    }

    #[Route('/packer-log/detail/{id}', name: 'packer_log_detail')]
    public function detailAction(int $id, ErpService $erp): Response
    {

        $endDate = new \DateTimeImmutable();
        $startDate = $endDate->sub(new \DateInterval("P1M"));

        $repo = $erp->getPackerLogEntryRepository();

        $offset = 0;
        $limit = 1000;
        
        $data = [
            'totalShipments' => 0,
            'totalItems' => 0
        ];

        do {

            $response = $repo->findByStartDateAndEndDate($startDate, $endDate, $limit, $offset);
            $entries = $response->getPackerLogEntries();

            foreach ($entries as $entry) {
                if ($entry->getUserId() == $id) {
                    $data['totalShipments'] ++;
                    $data['totalItems'] += $entry->getQtyShipped();
                }
            }

            $offset = $offset + $limit;
        } while (sizeof($entries) > 0);

        return $this->render('packer-log/index.html.twig', [
            'userId' => $id,
            'averagePackagesPerDay' => $data['totalShipments'] / 20,
            'averageItemsPerDay' => $data['totalItems'] / 20
        ]);
    }
}
