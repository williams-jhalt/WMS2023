<?php

namespace App\Controller;

use App\Model\Product;
use App\Service\ErpService;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppProductLookupController extends AbstractController
{
    #[Route('/product-lookup/', name: 'product_lookup_index')]
    public function index(): Response
    {
        return $this->render('product-lookup/index.html.twig');
    }

    #[Route('/product-lookup/search', name: 'product_lookup_search')]
    public function searchAction(ProductService $productRepo, Request $request): Response
    {

        $searchTerms = $request->get('searchTerms');

        $items = $productRepo->findBySearchTerms($searchTerms);

        return $this->render('product-lookup/search.html.twig', [
            'items' => $items
        ]);
    }

    #[Route('/product-lookup/committed-data', name: 'product_lookup_committed_data')]
    public function committeDataAction(ProductService $productRepo, Request $request): JsonResponse
    {
        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);

        $length = $request->get('length');
        $offset = $start + $length;

        $items = $productRepo->getCommittedProducts($length, $offset);

        return $this->json([
            'draw' => $draw,
            'recordsTotal' => sizeof($items),
            'recordsFiltered' => sizeof($items),
            'data' => $items
        ]);
    }

    #[Route('/product-lookup/committed', name: 'product_lookup_committed')]
    public function committedAction(ProductService $productRepo, Request $request): Response
    {
        return $this->render('product-lookup/committed.html.twig');
    }

    #[Route('/product-lookup/edit/{id}', name: 'product_lookup_edit')]
    public function editAction(int $id, Request $request): Response
    {

        // TODO
        $product = "";
        $formView = "";

        return $this->render('product-lookup/edit.html.twig', [
            'product' => $product,
            'form' => $formView
        ]);
    }
}
