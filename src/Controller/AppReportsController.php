<?php

namespace App\Controller;

use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppReportsController extends AbstractController
{
    #[Route('/reports', name: 'reports_index')]
    public function index(Request $request, OrderService $service): Response
    {

        $reports = [];

        $finder = new Finder();
        $finder->files()->name("*.json")->in($this->getParameter('kernel.project_dir') . '/public/data');

        foreach ($finder as $file) {
            $reports[] = [
                'type' => $file->getBasename(".json"),
                'filename' => $request->getBasePath() . "/data/" . $file->getBasename()
            ];
        }

        return $this->render('reports/index.html.twig', [
            'reports' => $reports
        ]);
    }
}
