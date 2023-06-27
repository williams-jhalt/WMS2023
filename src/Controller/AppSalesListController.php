<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class AppSalesListController extends AbstractController
{
    #[Route('/sales-list/', name: 'sales_list_index')]
    public function index(): Response
    {

        // TODO
        $products = "";
        return $this->render('sales-list/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/sales-list/remove-product', name: 'sales_list_remove')]
    public function removeProductAction(Request $request): Response
    {

        // TODO

        return $this->redirectToRoute('sales_list_index');        
    }

    #[Route('/sales-list/import-products', name: 'sales_list_import')]
    public function importListAction(Request $request): Response
    {

        // TODO

        return $this->redirectToRoute('sales_list_index');        

    }

    #[Route('/sales-list/add-product', name: 'sales_list_add')]
    public function addProductAction(Request $request): Response
    {
        
        // TODO

        return $this->redirectToRoute('sales_list_index');        
    }

    #[Route('/sales-list/export', name: 'sales_list_export')]
    public function exportListAction(): Response
    {

        $response = new StreamedResponse();

        // TODO

        return $response;
    }
}
