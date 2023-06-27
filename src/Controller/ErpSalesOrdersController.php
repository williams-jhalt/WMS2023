<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErpSalesOrdersController extends AbstractController
{
    #[Route('/erp/sales/orders', name: 'app_erp_sales_orders')]
    public function index(): Response
    {
        return $this->render('erp_sales_orders/index.html.twig', [
            'controller_name' => 'ErpSalesOrdersController',
        ]);
    }
}
