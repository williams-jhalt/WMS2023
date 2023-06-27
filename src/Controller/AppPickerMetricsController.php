<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppPickerMetricsController extends AbstractController
{
    #[Route('/picker-metrics/', name: 'picker_metrics_index')]
    public function index(): Response
    {
        return $this->render('picker-metricks/index.html.twig');
    }
}
