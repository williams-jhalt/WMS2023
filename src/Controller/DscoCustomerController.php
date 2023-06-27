<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DscoCustomerController extends AbstractController
{
    #[Route('/dsco/customer', name: 'dsco_customer_index')]
    public function index(): Response
    {
        return $this->render('dsco_customer/index.html.twig', [
            'controller_name' => 'DscoCustomerController',
        ]);
    }
}
