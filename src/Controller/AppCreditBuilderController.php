<?php

namespace App\Controller;

use App\Model\CreditEstimate;
use App\Service\OrderService;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AppCreditBuilderController extends AbstractController
{
    #[Route('/credits', name: 'credits_index')]
    public function index(): Response
    {
        return $this->render('credits/index.html.twig');
    }

    #[Route('/credits/list', name: 'credits_list')]
    public function listAction(Request $request, OrderService $orderService, ProductService $productService, Session $session): Response
    {

        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $manifestId = $request->get('manifestId');

        if (strpos($manifestId, '-') !== false) {
            list($orderNumber, $recordSequence) = explode('-', $manifestId);
        } else {
            $orderNumber = $manifestId;
        }

        $salesOrder = $orderService->getOrder($orderNumber, $company);
        $salesOrderItems = $orderService->getOrderItems($orderNumber, $company);

        $creditEstimate = new CreditEstimate($productService, $salesOrder, $salesOrderItems);

        return $this->render('credits/view.html.twig', [
            'creditEstimate' => $creditEstimate
        ]);
    }
}
