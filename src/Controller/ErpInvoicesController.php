<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErpInvoicesController extends AbstractController
{
    #[Route('/erp/invoices', name: 'app_erp_invoices')]
    public function index(): Response
    {
        return $this->render('erp_invoices/index.html.twig', [
            'controller_name' => 'ErpInvoicesController',
        ]);
    }
}
