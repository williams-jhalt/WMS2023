<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppOrderWatcherController extends AbstractController
{
    #[Route('/order-watcher/', name: 'order_watcher_index')]
    public function index(): Response
    {

        // TODO
        $newMuffsOrders = "";
        $newWilliamsOrders = "";

        return $this->render('order-watcher/index.html.twig', [
            'muffs_orders' => $newMuffsOrders,
            'williams_orders' => $newWilliamsOrders
        ]);
    }
}
