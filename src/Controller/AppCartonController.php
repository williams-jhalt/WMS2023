<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\OrderService;

class AppCartonController extends AbstractController
{
    #[Route('/carton', name: 'carton_index')]
    public function index(): Response
    {
        return $this->render('carton/index.html.twig');
    }

    #[Route('/carton/view', name: "carton_view")]
    public function viewAction(Request $request, OrderService $orderService, Session $session): Response
    {

        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $manifestId = $request->get('manifestId');

        list($orderNumber, $recordSequence) = explode('-', $manifestId);

        $cartons = $orderService->getCartons($orderNumber, $company);        

        return $this->render('carton/view.html.twig', [
            'manifestId' => $manifestId,
            'cartons' => $cartons
        ]);
    }
}
