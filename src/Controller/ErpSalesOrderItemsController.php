<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use ErpBundle\Model\SalesOrderItemCollection;
use ErpBundle\Service\ErpService;

class SalesOrderItemsController extends AbstractFOSRestController {

    /**
     * 
     * @return ErpService
     */
    private function getErpService() {
        return $this->get('williams_erp.service');
    }

    /**
     * @param int $orderNumber
     * @return View
     */
    public function getItemsAction($orderNumber) {
        
        $repo = $this->getErpService()->getSalesOrderRepository();

        $items = $repo->getItems((int)$orderNumber);

        $view = $this->view($items, 200);

        return $this->handleView($view);
    }

}
