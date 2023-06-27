<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DscoCustomerController extends AbstractController
{
    #[Route('/dsco/customer', name: 'dsco_customer_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('dsco_customer_list');
    }

    #[Route('/dsco/customer/list', name: 'dsco_customer_list')]
    public function listAction(): Response 
    {

        // TODO
        $customers = "";

        return $this->render('dsco/customer/list.html.twig', [
            'items' => $customers
        ]);
    }

    #[Route('/dsco/customer/new', name: 'dsco_customer_new')]
    public function newAction(Request $request): Response
    {

        // TODO
        $formView = "";

        return $this->render('dsco/customer/new.html.twig', [
            'form' => $formView
        ]);
    }

    #[Route('/dsco/customer/view/{id}', name: 'dsco_customer_view')]
    public function viewAction(int $id, Request $request): Response
    {

        // TODO
        $customer = "";

        return $this->render('dsco/customer/view/html.twig', [
            'item' => $customer
        ]);
    }

    #[Route('/dsco/customer/edit/{id}', name: 'dsco_customer_edit')]
    public function editAction(int $id, Request $request): Response
    {

        // TODO
        $customer = "";
        $formView = "";

        return $this->render('dsco/customer/edit.html.twig', [
            'form' => $formView,
            'item' => $customer
        ]);
    }

    #[Route('/dsco/customer/delete/{id}', name: 'dsco_customer_delete')]
    public function deleteAction(int $id, Request $request): Response
    {

        // TODO
        $customer = "";
        $formView = "";

        return $this->render('dsco/customer/delete.html.twig', [
            'form' => $formView,
            'item' => $customer
        ]);
    }
}
