<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppSalesOrdersController extends AbstractController
{
    #[Route('/orders/', name: 'sales_orders_index')]
    public function index(): Response
    {
        return $this->render('sales-orders/index.html.twig');
    }

    #[Route('/orders/MFG', name: 'sales_orders_index_mfg')]
    public function mfgIndexAction(): Response
    {
        return $this->render('sales-orders/mfg_index.html.twig');
    }

    #[Route('/orders/list', name: 'sales_orders_list')]
    public function listAction(Request $request): Response
    {
        // TODO
        $salesOrder = "";

        return $this->render('sales-orders/view.html.twig', [
            'order' => $salesOrder
        ]);
    }

    #[Route('/orders/MFG/list', name: 'sales_orders_list_mfg')]
    public function mfgListAction(Request $request): Response
    {
        // TODO
        $salesOrder = "";

        return $this->render('sales-orders/view.html.twig', [
            'order' => $salesOrder
        ]);
    }
}
