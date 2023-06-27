<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogicBrokerOrderStatusController extends AbstractController
{
    #[Route('/logicbroker/orderstatus/', name: 'logicbroker_orderstatus_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('logicbroker_orderstatus_list');
    }

    #[Route('/logicbroker/orderstatus/list', name: 'logicbroker_orderstatus_list')]
    public function listAction(Request $request): Response
    {

        // TODO
        $orderStatuses = "";

        return $this->render('logicbroker/orderstatus/list.html.twig', [
            'items' => $orderStatuses
        ]);
    }

    #[Route('/logicbroker/orderstatus/view/{id}', name: 'logicbroker_orderstatus_view')]
    public function viewAction(int $id, Request $request): Response
    {

        // TODO
        $status = "";

        return $this->render('logicbroker/orderstatus/view.html.twig', [
            'item' => $status
        ]);
    }
}
