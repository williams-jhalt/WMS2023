<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErpShipmentsController extends AbstractController
{
    #[Route('/erp/shipments', name: 'app_erp_shipments')]
    public function index(): Response
    {
        return $this->render('erp_shipments/index.html.twig', [
            'controller_name' => 'ErpShipmentsController',
        ]);
    }
}
