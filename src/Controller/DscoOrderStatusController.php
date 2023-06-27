<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DscoOrderStatusController extends AbstractController
{
    #[Route('/dsco/order/status', name: 'dsco_orderstatus_index')]
    public function index(): Response
    {
        return $this->render('dsco_order_status/index.html.twig', [
            'controller_name' => 'DscoOrderStatusController',
        ]);
    }
}
