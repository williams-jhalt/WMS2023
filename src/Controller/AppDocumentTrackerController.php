<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppDocumentTrackerController extends AbstractController
{
    #[Route('/document-tracker', name: 'document_tracker_index')]
    public function index(): Response
    {
        return $this->render('document-tracker/index.html.twig');
    }

    #[Route('/document-tracker/scan', name: 'document_tracker_scan')]
    public function scanAction(Request $request): Response
    {
        // TODO
        $messages = "";

        return new Response(json_encode(['messages' => $messages]));
    }

    #[Route('/document-tracker/list', name: 'document_tracker_list')]
    public function listAction(Request $request): Response
    {

        // TODO
        $scans = "";

        return $this->render('document-tracker/list.html.twig', [
            'scans' => $scans
        ]);
    }

    #[Route('/document-tracker/search', name: 'document_tracker_search')]
    public function searchAction(Request $request): Response
    {

        // TODO
        $scans = "";

        return $this->render('document-tracker/search.html.twig', [
            'scans' => $scans
        ]);
    }

}
