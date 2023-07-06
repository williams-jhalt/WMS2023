<?php

namespace App\Controller;

use App\Model\Erp\ShipmentPackage;
use App\Service\OrderService;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AppHandheldController extends AbstractController
{
    #[Route('/handheld', name: 'app_handheld')]
    public function index(): Response
    {
        return $this->render('app_handheld/index.html.twig', [
            'controller_name' => 'AppHandheldController',
        ]);
    }

    #[Route('/handheld/inventory', name: 'app_handheld_inventory')]
    public function inventory(): Response
    {
        return $this->render('app_handheld/inventory.html.twig', [
            'controller_name' => 'AppHandheldController',
        ]);
    }

    #[Route('/handheld/inventory/product-lookup', name: 'app_handheld_inventory_product_lookup')]
    public function productLookup(Request $request, ProductService $repo, Session $session): Response
    {

        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $warehouse = $session->get('warehouse', $this->getParameter('app.erp.warehouse'));
        $searchTerms = $request->get("searchTerms");

        $products = [];

        if ($searchTerms != null) {
            $products = $repo->findBySearchTerms($searchTerms, 25, 0, $company, $warehouse);
        }

        return $this->render('app_handheld/inventory_product_lookup.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/handheld/inventory/product-receive', name: 'app_handheld_inventory_product_receive')]
    public function productReceive(): Response
    {
        return $this->render('app_handheld/inventory_product_receive.html.twig');
    }

    #[Route('/handheld/inventory/product-putaway', name: 'app_handheld_inventory_product_putaway')]
    public function productPutaway(): Response
    {
        return $this->render('app_handheld/inventory_product_putaway.html.twig');
    }

    #[Route('/handheld/inventory/product-count', name: 'app_handheld_inventory_product_count')]
    public function productCount(): Response
    {
        return $this->render('app_handheld/inventory_product_count.html.twig');
    }

    #[Route('/handheld/shipping', name: 'app_handheld_shipping')]
    public function shipping(): Response
    {
        return $this->render('app_handheld/shipping.html.twig', [
            'controller_name' => 'AppHandheldController',
        ]);
    }

    #[Route('/handheld/shipping/carton-lookup', name: 'app_handheld_shipping_carton_lookup')]
    public function shippingCartonLookup(Request $request, OrderService $orderService, Session $session): Response
    {

        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $carton = null;
        $ucc = $request->get('ucc');

        if ($ucc != null) {

            try {
                $carton = $orderService->getCarton($ucc, $company);   
            } catch (\Exception $e) {
                $this->addFlash("warning", $e->getMessage());
            }        


        }

        return $this->render('app_handheld/shipping_carton_lookup.html.twig', [
            'carton' => $carton
        ]);
    }


}
