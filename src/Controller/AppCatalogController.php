<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppCatalogController extends AbstractController
{
    #[Route('/catalog/', name: 'catalog_homepage')]
    public function index(): Response
    {
        return $this->render('catalog/index.html.twig');
    }

    #[Route('/catalog/search', name: 'catalog_search')]
    public function searchAction(Request $request): Response
    {

        // TODO
        $searchTerms = "";
        $products = "";

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
