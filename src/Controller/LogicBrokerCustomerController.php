<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogicBrokerCustomerController extends AbstractController
{   
    
    #[Route('/logicbroker/customer', name: 'logicbroker_customer_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('logicbroker_customer_list');
    }

    #[Route('/logicbroker/customer/list', name: 'logicbroker_customer_list')]
    public function listAction(): Response 
    {

        // TODO
        $customers = "";

        return $this->render('logicbroker/customer/list.html.twig', [
            'items' => $customers
        ]);
    }

    #[Route('/logicbroker/customer/new', name: 'logicbroker_customer_new')]
    public function newAction(Request $request): Response
    {

        // TODO
        $formView = "";

        return $this->render('logicbroker/customer/new.html.twig', [
            'form' => $formView
        ]);
    }

    #[Route('/logicbroker/customer/view/{id}', name: 'logicbroker_customer_view')]
    public function viewAction(int $id, Request $request): Response
    {

        // TODO
        $customer = "";

        return $this->render('logicbroker/customer/view/html.twig', [
            'item' => $customer
        ]);
    }

    #[Route('/logicbroker/customer/edit/{id}', name: 'logicbroker_customer_edit')]
    public function editAction(int $id, Request $request): Response
    {

        // TODO
        $customer = "";
        $formView = "";

        return $this->render('logicbroker/customer/edit.html.twig', [
            'form' => $formView,
            'item' => $customer
        ]);
    }

    #[Route('/logicbroker/customer/delete/{id}', name: 'logicbroker_customer_delete')]
    public function deleteAction(int $id, Request $request): Response
    {

        // TODO
        $customer = "";
        $formView = "";

        return $this->render('logicbroker/customer/delete.html.twig', [
            'form' => $formView,
            'item' => $customer
        ]);
    }
}
