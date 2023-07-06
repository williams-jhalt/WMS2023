<?php

namespace App\Controller;

use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AppDimWatcherController extends AbstractController
{
    #[Route('/dimwatcher', name: 'dimwatcher_index')]
    public function index(): Response
    {
        return $this->render('dimwatcher/index.html.twig');
    }

    #[Route('/dimwatcher/list', name: 'dimwatcher_list')]
    public function listAction(Request $request, OrderService $orderService, Session $session): Response
    {

        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $manifestId = $request->get('manifestId');

        if (strpos($manifestId, '-') !== false) {
            list($orderNumber, $recordSequence) = explode('-', $manifestId);
        } else {
            $orderNumber = $manifestId;
        }

        $salesOrder = $orderService->getOrder($orderNumber, $company);

        return $this->render('dimwatcher/view.html.twig', [
            'order' => $salesOrder
        ]);
    }
}
