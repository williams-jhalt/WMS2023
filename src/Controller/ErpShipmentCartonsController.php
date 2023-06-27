<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErpShipmentCartonsController extends AbstractController
{
    #[Route('/erp/shipment/cartons', name: 'app_erp_shipment_cartons')]
    public function index(): Response
    {
        return $this->render('erp_shipment_cartons/index.html.twig', [
            'controller_name' => 'ErpShipmentCartonsController',
        ]);
    }
}
