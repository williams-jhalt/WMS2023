<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppHandheldController extends AbstractController
{
    #[Route('/handheld', name: 'app_handheld')]
    public function index(): Response
    {
        return $this->render('app_handheld/index.html.twig', [
            'controller_name' => 'AppHandheldController',
        ]);
    }
}
