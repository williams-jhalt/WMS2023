<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DscoOrderStatusController extends AbstractController
{
    #[Route('/dsco/orderstatus/', name: 'dsco_orderstatus_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('dsco_orderstatus_list');
    }

    #[Route('/dsco/orderstatus/list', name: 'dsco_orderstatus_list')]
    public function listAction(Request $request): Response
    {

        // TODO
        $orderStatuses = "";

        return $this->render('dsco/orderstatus/list.html.twig', [
            'items' => $orderStatuses
        ]);
    }

    #[Route('/dsco/orderstatus/view/{id}', name: 'dsco_orderstatus_view')]
    public function viewAction(int $id, Request $request): Response
    {

        // TODO
        $status = "";

        return $this->render('dsco/orderstatus/view.html.twig', [
            'item' => $status
        ]);
    }
}
