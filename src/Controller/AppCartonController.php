<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppCartonController extends AbstractController
{
    #[Route('/carton/', name: 'carton_index')]
    public function index(): Response
    {
        return $this->render('carton/index.html.twig');
    }

    #[Route('/carton/view', name: "carton_view")]
    public function viewAction(Request $request): Response
    {

        // TODO
        $manifestId = "";
        $cartons = "";        

        return $this->render('carton/view.html.twig', [
            'manifestId' => $manifestId,
            'cartons' => $cartons
        ]);
    }
}
