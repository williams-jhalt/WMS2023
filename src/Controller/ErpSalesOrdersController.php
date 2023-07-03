<?php

namespace App\Controller;

use AppBundle\Form\OrderType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Erp\Order;
use App\Model\Erp\SalesOrderCollection;
use App\Service\ErpService;

class ErpSalesOrdersController extends AbstractFOSRestController {

    /**
     * 
     * @return ErpService
     */
    private function getErpService() {
        return $this->get('williams_erp.service');
    }

    public function postOrderAction(Request $request) {

        $order = new Order();

        $form = $this->createForm(OrderType::class, $order);

        $form->submit($request->request->get($form->getName()));

        if ($form->isSubmitted() && $form->isValid()) {

            $repo = $this->getErpService()->getSalesOrderRepository();

            $response = $repo->submitOrder($order);

            $view = $this->view($response, 200);

            return $this->handleView($view);
        }

        $view = $this->view($form, 200);

        return $this->handleView($view);
    }

    public function getWeborderAction($identifier) {

        list($webReferenceNumber, $customerNumber) = explode("-", $identifier);

        $repo = $this->getErpService()->getSalesOrderRepository();

        $salesOrder = $repo->getByWebReferenceNumberAndCustomerNumber($webReferenceNumber, $customerNumber);

        $view = $this->view($salesOrder, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\QueryParam(name="offset", requirements="\d+", default="0", description="Offset of record to start at")
     * @Rest\QueryParam(name="limit", requirements="\d+", default="100", description="Number of items to return")
     * @Rest\QueryParam(name="search", description="Optional search terms")
     * @Rest\QueryParam(name="start_date", description="Optional start date of orders to be returned")
     * @Rest\QueryParam(name="end_date", description="Required if start date is set")
     * @Rest\QueryParam(name="customer_number", description="Limit results to orders owned by customer")
     * @Rest\QueryParam(name="open", description="If true, limit orders returned to open orders")
     */
    public function getOrdersAction(ParamFetcher $paramFetcher) {

        $limit = (int) $paramFetcher->get('limit');
        $offset = (int) $paramFetcher->get('offset');
        $search = $paramFetcher->get('search');
        $startDate = $paramFetcher->get('start_date');
        $endDate = $paramFetcher->get('end_date');
        $customerNumber = $paramFetcher->get('customer_number');
        $open = $paramFetcher->get('open', false);

        $repo = $this->getErpService()->getSalesOrderRepository();

        if (!empty($search)) {
            $salesOrders = $repo->findByTextSearch($search);
        } elseif (!empty($startDate)) {
            $sd = new DateTime($startDate);
            $ed = new DateTime($endDate);
            if (!empty($customerNumber)) {
                $salesOrders = $repo->findByCustomerNumberAndOrderDate($customerNumber, $sd, $ed, $limit, $offset);
            } else {
                $salesOrders = $repo->findByOrderDate($sd, $ed, $limit, $offset);
            }
        } elseif ($open) {
            $salesOrders = $repo->findOpen($limit, $offset);
        } else {
            $salesOrders = $repo->findAll($limit, $offset);
        }

        $view = $this->view($salesOrders, 200);

        return $this->handleView($view);
    }

    public function getOrderAction($orderNumber) {

        $repo = $this->getErpService()->getSalesOrderRepository();

        $salesOrder = $repo->get((int) $orderNumber);

        $view = $this->view($salesOrder, 200);

        return $this->handleView($view);
    }

}
