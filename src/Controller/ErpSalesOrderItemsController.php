<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use App\Model\Erp\SalesOrderItemCollection;
use App\Service\ErpService;

class ErpSalesOrderItemsController extends AbstractFOSRestController {

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
