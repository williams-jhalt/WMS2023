<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErpCustomersController extends AbstractController
{
    #[Route('/erp/customers', name: 'app_erp_customers')]
    public function index(): Response
    {
        return $this->render('erp_customers/index.html.twig', [
            'controller_name' => 'ErpCustomersController',
        ]);
    }
}
