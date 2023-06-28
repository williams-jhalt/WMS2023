<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function searchAction(Request $request): Response
    {
        //TODO
        $items = "";

        return $this->render('product-lookup/search.html.twig', [
            'items' => $items
        ]);
    }

    #[Route('/product-lookup/committed', name: 'product_lookup_committed')]
    public function committedAction(Request $request): Response
    {
        // TODO
        $items = "";
        $page = "";

        return $this->render('product-lookup/committed.html.twig', [
            'items' => $items,
            'page' => $page
        ]);
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
