<?php

namespace App\Controller;

use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AppSalesOrdersController extends AbstractController
{
    #[Route('/orders', name: 'sales_orders_index')]
    public function index(): Response
    {
        return $this->render('sales-orders/index.html.twig');
    }

    #[Route('/orders/list', name: 'sales_orders_list')]
    public function listAction(Request $request, OrderService $service, Session $session): Response
    {

        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $manifestId = $request->get('manifestId');

        if (strpos($manifestId, '-') !== false) {
            list($orderNumber, $recordSequence) = explode('-', $manifestId);
        } else {
            $orderNumber = $manifestId;
        }

        $salesOrder = $service->getOrder($orderNumber, $company);

        return $this->render('sales-orders/view.html.twig', [
            'order' => $salesOrder
        ]);
    }
}
