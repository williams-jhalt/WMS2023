<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppShippingController extends AbstractController
{
    #[Route('/shipping/', name: 'shipping_index')]
    public function index(): Response
    {

        // TODO
        $printerNames = "";
        $selectedPrinter = "";

        return $this->render('shipping/index.html.twig', [
            'printers' => $printerNames,
            'selectedPrinter' => $selectedPrinter
        ]);
    }

    #[Route('/shipping/review', name: 'shipping_review')]
    public function reviewAction(Request $request): Response
    {

        // TODO
        $shipment = "";

        return $this->render('shipping/review.html.twig', [
            'shipment' => $shipment
        ]);
    }
}
