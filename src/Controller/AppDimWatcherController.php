<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppDimWatcherController extends AbstractController
{
    #[Route('/dimwatcher/', name: 'dimwatcher_index')]
    public function index(): Response
    {
        return $this->render('dimwatcher/index.html.twig');
    }

    #[Route('/dimwatcher/list', name: 'dimwatcher_list')]
    public function listAction(Request $request): Response
    {
        // TODO
        $salesOrder = "";

        return $this->render('dimwatcher/view.html.twig', [
            'order' => $salesOrder
        ]);
    }
}
