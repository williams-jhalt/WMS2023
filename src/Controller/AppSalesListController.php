<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class AppSalesListController extends AbstractController
{
    #[Route('/sales-list', name: 'sales_list_index')]
    public function index(Session $session): Response
    {
        $products = $session->get("sales-list", []);

        return $this->render('sales-list/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/sales-list/remove-product', name: 'sales_list_remove')]
    public function removeProductAction(Request $request, Session $session): Response
    {
        
        $item = $request->get('itemNumber');
        $list = $session->get("sales-list", []);

        unset($list[$item]);

        $session->set('sales-list', $list);

        return $this->redirectToRoute('sales_list_index');        
    }

    #[Route('/sales-list/import-products', name: 'sales_list_import')]
    public function importListAction(Request $request, Session $session, ProductService $service): Response
    {

        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $warehouse = $session->get('warehouse', $this->getParameter('app.erp.warehouse'));
        $input = preg_split('/[\s,]+/', $request->get('import'));
        $list = $session->get('sales-list', []);

        foreach ($input as $key) {
            $itemNumber = trim($key);

            if (!empty($itemNumber)) {
                $result = $service->findBySearchTerms($itemNumber, 25, 0, $company, $warehouse);

                if (sizeof($result) == 1) {
                    $list[$result[0]->getItemNumber()] = $result[0];
                }
            }
        }

        $session->set('sales-list', $list);

        return $this->redirectToRoute('sales_list_index');        

    }

    #[Route('/sales-list/add-product', name: 'sales_list_add')]
    public function addProductAction(Request $request, Session $session, ProductService $service): Response
    {
        
        $search = $request->get('search');

        $results = $service->findBySearchTerms($search);

        if (sizeof($results) > 1) {
            return $this->render('sales-list/choose.html.twig', [
                'products' => $results
            ]);
        } elseif (sizeof($results) == 0) {
            $this->addFlash("warning", "NO PRODUCT FOUND");
            return $this->redirectToRoute('sales_list_index');
        }

        $list = $session->get("sales-list", []);

        $list[$results[0]->getItemNumber()] = $results[0];

        $session->set("sales-list", $list);

        return $this->redirectToRoute('sales_list_index');        
    }

    #[Route('/sales-list/export', name: 'sales_list_export')]
    public function exportListAction(Session $session): StreamedResponse
    {

        $response = new StreamedResponse();
        
        $response->setCallback(function() use ($session) {
            $items = $session->get('sales-list', []);
            $handle = fopen('php://output', 'w+');
            fputcsv($handle, ['Item Number', 'Description', 'Type', 'Vendor', 'Barcode', 'Url']);
            foreach ($items as $product) {
                $row = [
                    $product->getItemNumber(),
                    $product->getName(),
                    $product->getProductType() != null ? $product->getProductType()->getCode() : "",
                    $product->getManufacturer() != null ? $product->getManufacturer()->getCode() : "",
                    $product->getBarcode(),
                    $this->getParameter('app.product_url') . $product->getItemNumber()
                ];

                fputcsv($handle, $row);
            }

            fclose($handle);
        });

        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv;charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');

        return $response;
    }
}
