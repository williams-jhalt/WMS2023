<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use App\Service\ErpService;

class ErpCustomersController extends AbstractFOSRestController {

    /**
     * @return ErpService
     */
    private function getErpService() {
        return $this->get('williams_erp.service');
    }

    /**
     * @Rest\QueryParam(name="offset", requirements="\d+", default="0", description="Offset of record to start at")
     * @Rest\QueryParam(name="limit", requirements="\d+", default="1000", description="Number of items to return")
     * @Rest\QueryParam(name="search", description="Optional search terms")
     * 
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getCustomersAction(ParamFetcher $paramFetcher) {

        $limit = $paramFetcher->get('limit');
        $offset = $paramFetcher->get('offset');
        $searchTerms = $paramFetcher->get('search');

        $customerRepo = $this->getErpService()->getCustomerRepository();

        if (!empty($searchTerms)) {
            $products = $customerRepo->findByTextSearch($searchTerms, $limit, $offset);
        } else {
            $products = $customerRepo->findAll($limit, $offset);
        }

        $view = $this->view($products, 200);

        return $this->handleView($view);
    }

    public function getCustomerAction($customerNumber) {
        $customerRepo = $this->getErpService()->getCustomerRepository();

        $customer = $customerRepo->getByCustomerNumber($customerNumber);

        $view = $this->view($customer, 200);

        return $this->handleView($view);
    }

}
