<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\WholesaleService;

class AppCatalogController extends AbstractController
{

    private $wholesaleService;

    public function __construct(WholesaleService $wholesaleService) {
        $this->wholesaleService = $wholesaleService;
    }


    #[Route('/catalog/', name: 'catalog_homepage')]
    public function index(): Response
    {
        return $this->render('catalog/index.html.twig');
    }

    #[Route('/catalog/search', name: 'catalog_search')]
    public function searchAction(Request $request): Response
    {

        // TODO
        $searchTerms = $request->get('searchTerms');

        $service = $this->wholesaleService->getProductRepository();

        $wholesaleProducts = $service->findBySearchTerms($searchTerms);

        $products = [];

        foreach ($wholesaleProducts as $p) {
            $product = new Product();
            $product->setItemNumber($p->getSku());

            $products[] = $product;
        }

        return $this->render('catalog/search.html.twig', [
            'searchTerms' => $searchTerms,
            'products' => $products
        ]);
    }

    #[Route('/catalog/edit/{id}', name: 'catalog_edit')]
    public function editAction(int $id, Request $request): Response
    {

        // TODO
        $product = "";
        $formView = "";

        return $this->render('catalog/edit.html.twig', [
            'product' => $product,
            'form' => $formView
        ]);
    }

    #[Route('/catalog/remove/{id}', name: 'catalog_remove')]
    public function removeAction(int $id, Request $request): Response
    {
        // TODO
        return $this->redirectToRoute('catalog_search');   
    }

}
