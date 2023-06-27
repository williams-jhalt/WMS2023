<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErpShipmentItemsController extends AbstractController
{
    #[Route('/erp/shipment/items', name: 'app_erp_shipment_items')]
    public function index(): Response
    {
        return $this->render('erp_shipment_items/index.html.twig', [
            'controller_name' => 'ErpShipmentItemsController',
        ]);
    }
}
