<?php

namespace App\Controller;

use App\Entity\PickerLog;
use App\Repository\PickerLogRepository;
use App\Service\OrderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AppPickerLogController extends AbstractController
{
    #[Route('/picker-log', name: 'picker_log_index')]
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
    public function scanAction(Request $request, EntityManagerInterface $em): Response
    {

        $manifestId = $request->get('orderNumber');
        $user = $request->get('user');
        $lineCount = $request->get('lineCount');
        $pageCount = $request->get('pageCount');

        $messages = [];

        if (!preg_match("/\d+-\d+/", $manifestId)) {
            $messages[] = "Not a valid order number";
        }

        if (sizeof($messages) == 0) {
            $scan = new PickerLog();
            $scan->setOrderNumber($manifestId);
            $scan->setUsername($user);
            $scan->setLineCount($lineCount);
            $scan->setPageCount($pageCount);
            $em->persist($scan);
            $em->flush();
        }

        return new Response(json_encode(['messages' => $messages]));
    }

    #[Route('/picker-log/single-pick-scan', name: 'picker_log_single_pick_scan')]
    public function singlePickScanAction(Request $request, OrderService $service, EntityManagerInterface $em, Session $session): Response
    {

        $company = $session->get('company', $this->getParameter('app.erp.company'));
        $manifestId = $request->get('orderNumber');
        $user = $request->get('user');

        $messages = [];

        if (!preg_match("/\d+-\d+/", $manifestId)) {
            $messages[] = "Not a valid order number";
        }

        list($orderNumber, $recordSequence) = explode('-', $manifestId);

        $items = $service->getShipmentItems($orderNumber, $recordSequence, $company);

        $query = $em->createQuery(
            'SELECT o '
            . 'FROM App\Entity\PickerLog o '
            . 'WHERE o.orderNumber = :orderNumber '
            . 'ORDER BY o.timestamp DESC'
        )
        ->setParameter('orderNumber', $manifestId)
        ->setMaxResults(1);

        if (sizeof($messages) == 0) {
            $scan = new PickerLog();
            $scan->setOrderNumber($manifestId);
            $scan->setUsername($user);
            $scan->setLineCount(count($items));
            $scan->setPageCount(ceil(count($items) / 30));
            $em->persist($scan);
            $em->flush();
        }

        return new Response(json_encode(['messages' => $messages]));
    }

    #[Route('/picker-log/list', name: 'picker_log_list')]
    public function listAction(Request $request, PickerLogRepository $repo): Response
    {

        $scans = $repo->findBy([], ['timestamp' => 'desc']);

        return $this->render('picker-log/list.html.twig', [
            'scans' => $scans
        ]);
    }

    #[Route('/picker-log/search', name: 'picker_log_search')]
    public function searchAction(Request $request, EntityManagerInterface $em): Response
    {

        $searchTerms = $request->get('searchTerms');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        $qb = $em->createQueryBuilder()
            ->select('o')
            ->from('App\Entity\PickerLog', 'o');

        if (!empty($searchTerms)) {
            $qb->andWhere('o.orderNumber LIKE :Search or o.username = :user')
                ->setParameter('search', $searchTerms . "%")
                ->setParameter('user', $searchTerms);
        }

        if (!empty($startDate)) {
            $qb->andWhere('o.timestamp >= :startDAte')
                ->setParameter('startDate', new \DateTime($startDate));
        }

        if (!empty($endDate)) {
            $qb->andWhere('o.timestamp <= :endDate')
                ->setParameter('endDate', new \DateTime($endDate));
        }

        $qb->orderBy('o.timestamp', 'desc')->setMaxResults(50);

        $scans = $qb->getQuery()->getResult();

        return $this->render('picker-log/search.html.twig', [
            'scans' => $scans
        ]);
    }
}
