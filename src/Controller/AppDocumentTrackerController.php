<?php

namespace App\Controller;

use App\Entity\DocumentLog;
use App\Repository\DocumentLogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppDocumentTrackerController extends AbstractController
{
    #[Route('/document-tracker', name: 'document_tracker_index')]
    public function index(): Response
    {
        return $this->render('document-tracker/index.html.twig');
    }

    #[Route('/document-tracker/scan', name: 'document_tracker_scan')]
    public function scanAction(Request $request, EntityManagerInterface $em): Response
    {

        $orderNumber = $request->get('orderNumber');
        $user = $request->get('user');
        $documentAction = strtoupper($request->get('documentAction'));

        $messages = array();

        if (!preg_match("/\d+-\d+/", $orderNumber)) {
            $messages[] = "Not a valid order number";
        }

        if ($documentAction != 'CHECK IN' && $documentAction != 'CHECK OUT') {
            $messages[] = "Not a valid action";
        }

        $query = $em->createQuery(
                'SELECT o '
                . 'FROM App\Entity\DocumentLog o '
                . 'WHERE o.orderNumber = :orderNumber '
                . 'ORDER BY o.timestamp DESC'
            )
            ->setParameter('orderNumber', $orderNumber)
            ->setMaxResults(1);

        $test = $query->getOneOrNullResult();

        if ($test && $documentAction == $test->getDocumentAction()) {
            $messages[] = "$orderNumber has already been $documentAction";
        }

        if (sizeof($messages) == 0) {
            $scan = new DocumentLog();
            $scan->setOrderNumber($orderNumber);
            $scan->setUsername($user);
            $scan->setDocumentAction($documentAction);
            $em->persist($scan);
            $em->flush();
        }

        return new Response(json_encode(['messages' => $messages]));
    }

    #[Route('/document-tracker/list', name: 'document_tracker_list')]
    public function listAction(Request $request, DocumentLogRepository $repo): Response
    {
        $scans = $repo->findBy([], ['timestamp' => 'desc'], 50);

        return $this->render('document-tracker/list.html.twig', [
            'scans' => $scans
        ]);
    }

    #[Route('/document-tracker/search', name: 'document_tracker_search')]
    public function searchAction(Request $request, EntityManagerInterface $em): Response
    {
        $searchTerms = $request->get('searchTerms');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        $qb = $em->createQueryBuilder()
            ->select('o')
            ->from(DocumentLog::class, 'o');

        if (!empty($searchTerms)) {
            $qb->andWhere('o.orderNumber LIKE :search OR o.username = :user')
                ->setParameter('search', $searchTerms . "%")
                ->setParameter('user', $searchTerms);
        }

        if (!empty($startDate)) {
            $qb->andWhere('o.timestamp >= :startDate')
                ->setParameter('startDate', new \DateTime($startDate));
        }

        if (!empty($endDate)) {
            $qb->andWhere('o.timestamp <= :endDate')
                ->setParameter('endDate', new \DateTime($endDate));
        }

        $qb->orderBy('o.timestamp', 'desc')->setMaxResults(50);

        $scans = $qb->getQuery()->getResult();

        return $this->render('document-tracker/search.html.twig', [
            'scans' => $scans
        ]);
    }

}
