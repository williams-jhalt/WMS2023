<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppPackerLogController extends AbstractController
{
    #[Route('/packer-log/', name: 'packer_log_index')]
    public function index(Request $request): Response
    {

        // TODO
        $startDate = "";
        $endDate = "";
        $result = "";

        return $this->render('packer-log/index.html.twig', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'packerData' => $result
        ]);
    }

    #[Route('/packer-log/detail/{id}', name: 'packer_log_detail')]
    public function detailAction(int $id): Response
    {

        // TODO 
        $data = [
            'totalShipments' => 0,
            'totalItems' => 0
        ];

        return $this->render('packer-log/index.html.twig', [
            'userId' => $id,
            'averagePackagesPerDay' => $data['totalShipments'] / 20,
            'averageItemsPerDay' => $data['totalItems'] / 20
        ]);
    }
}
