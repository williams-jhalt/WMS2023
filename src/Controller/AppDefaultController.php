<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AppDefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/change-company', name: 'change_company_and_warehouse')]
    public function changeCompanyAction(Request $request, Session $session): Response
    {

        $session->set('company', $request->get('company', $this->getParameter('app.erp.company')));
        $session->set('warehouse', $request->get('warehouse', $this->getParameter('app.erp.warehouse')));

        $route = $request->headers->get('referer');

        return $this->redirect($route);

    }

}
