<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppReportsController extends AbstractController
{
    #[Route('/reports/', name: 'reports_index')]
    public function index(): Response
    {


        // TODO
        $reports = [];

        return $this->render('reports/index.html.twig', [
            'reports' => $reports
        ]);
    }
}
