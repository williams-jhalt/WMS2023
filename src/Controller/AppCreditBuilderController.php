<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppCreditBuilderController extends AbstractController
{
    #[Route('/credits/', name: 'credits_index')]
    public function index(): Response
    {
        return $this->render('credits/index.html.twig');
    }

    #[Route('/credits/list', name: 'credits_list')]
    public function listAction(Request $request): Response
    {
        // TODO
        $creditEstimate = "";

        return $this->render('credits/view.html.twig', [
            'creditEstimate' => $creditEstimate
        ]);
    }
}
