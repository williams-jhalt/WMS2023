<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErpProductsController extends AbstractController
{
    #[Route('/erp/products', name: 'app_erp_products')]
    public function index(): Response
    {
        return $this->render('erp_products/index.html.twig', [
            'controller_name' => 'ErpProductsController',
        ]);
    }
}
