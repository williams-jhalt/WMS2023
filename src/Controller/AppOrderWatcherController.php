<?php

namespace App\Controller;

use App\Service\MuffsWmsService;
use App\Service\WilliamsWmsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppOrderWatcherController extends AbstractController
{
    #[Route('/order-watcher/', name: 'order_watcher_index')]
    public function index(MuffsWmsService $muffsWms, WilliamsWmsService $williamsWms): Response
    {

        $newMuffsOrders = $muffsWms->getWeborderRepository()->getNewOrders();
        $newWilliamsOrders = $williamsWms->getWeborderRepository()->getNewOrders();

        return $this->render('order-watcher/index.html.twig', [
            'muffs_orders' => $newMuffsOrders,
            'williams_orders' => $newWilliamsOrders
        ]);
    }
}
