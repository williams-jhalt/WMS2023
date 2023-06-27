<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErpInvoiceItemsController extends AbstractController
{
    #[Route('/erp/invoice/items', name: 'app_erp_invoice_items')]
    public function index(): Response
    {
        return $this->render('erp_invoice_items/index.html.twig', [
            'controller_name' => 'ErpInvoiceItemsController',
        ]);
    }
}
