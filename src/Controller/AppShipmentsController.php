<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppShipmentsController extends AbstractController
{
    #[Route('/shipments/', name: 'shipments_index')]
    public function index(): Response
    {
        return $this->render('shipments/index.html.twig');
    }

    #[Route('/shipments/list', name: 'shipments_list')]
    public function listAction(Request $request): Response
    {
        $response = new Response();
        // TODO
        return $response;
    }
}
