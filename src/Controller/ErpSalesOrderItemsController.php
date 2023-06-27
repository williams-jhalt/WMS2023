<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErpSalesOrderItemsController extends AbstractController
{
    #[Route('/erp/sales/order/items', name: 'app_erp_sales_order_items')]
    public function index(): Response
    {
        return $this->render('erp_sales_order_items/index.html.twig', [
            'controller_name' => 'ErpSalesOrderItemsController',
        ]);
    }
}
