<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
