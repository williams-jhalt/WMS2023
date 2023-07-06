<?php

namespace App\Controller;

use App\Entity\ProductDetail;
use App\Form\ProductDetailType;
use App\Model\Product;
use App\Repository\ProductRepository;
use App\Service\ErpService;
use App\Service\ProductService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AppProductLookupController extends AbstractController
{
    #[Route('/product-lookup', name: 'product_lookup_index')]
    public function index(): Response
    {
        return $this->render('product-lookup/index.html.twig');
    }

    #[Route('/product-lookup/search', name: 'product_lookup_search')]
    public function searchAction(ProductService $productRepo, Request $request, Session $session): Response
    {

        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $warehouse = $session->get('warehouse', $this->getParameter('app.erp.warehouse'));
        $searchTerms = $request->get('searchTerms');

        $items = $productRepo->findBySearchTerms($searchTerms, 25, 0, $company, $warehouse);

        return $this->render('product-lookup/search.html.twig', [
            'items' => $items
        ]);
    }

    #[Route('/product-lookup/committed-data', name: 'product_lookup_committed_data')]
    public function committeDataAction(ProductService $productRepo, Request $request, Session $session): JsonResponse
    {
        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $warehouse = $session->get('warehouse', $this->getParameter('app.erp.warehouse'));
        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);

        $length = $request->get('length');
        $offset = $start + $length;

        $items = $productRepo->getCommittedProducts($length, $offset, $company, $warehouse);

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

}
