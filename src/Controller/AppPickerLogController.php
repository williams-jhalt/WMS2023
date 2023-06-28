<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppPickerLogController extends AbstractController
{
    #[Route('/picker-log/', name: 'picker_log_index')]
    public function index(): Response
    {
        return $this->render('picker-log/index.html.twig');
    }

    #[Route('/picker-log/single-pick', name: 'picker_log_single_pick')]
    public function singlePickAction(Request $request): Response
    {
        return $this->render('picker-log/single-pick.html.twig');
    }

    #[Route('/picker-log/scan', name: 'picker_log_scan')]
    public function scanAction(Request $request): Response
    {

        // TODO
        $messages = "";

        return new Response(json_encode(['messages' => $messages]));
    }

    #[Route('/picker-log/single-pick-scan', name: 'picker_log_single_pick_scan')]
    public function singlePickScanAction(Request $request): Response
    {

        // TODO
        $messages = "";

        return new Response(json_encode(['messages' => $messages]));
    }

    #[Route('/picker-log/list', name: 'picker_log_list')]
    public function listAction(Request $request): Response
    {

        // TODO
        $scans = "";

        return $this->render('picker-log/list.html.twig', [
            'scans' => $scans
        ]);
    }

    #[Route('/picker-log/search', name: 'picker_log_search')]
    public function searchAction(Request $request): Response
    {

        // TODO
        $scans = "";

        return $this->render('picker-log/search.html.twig', [
            'scans' => $scans
        ]);
    }
}
