<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogicBrokerCustomerController extends AbstractController
{
    #[Route('/logic/broker/customer', name: 'logicbroker_customer_index')]
    public function index(): Response
    {
        return $this->render('logic_broker_customer/index.html.twig', [
            'controller_name' => 'LogicBrokerCustomerController',
        ]);
    }
}
