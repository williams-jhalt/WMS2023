<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use App\Model\Erp\ShipmentPackageCollection;
use App\Service\ErpService;

class ErpShipmentCartonsController extends AbstractFOSRestController {
    
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
    public function getCartonsAction($orderNumber) {
                
        $repo = $this->getErpService()->getShipmentRepository();
        
        $items = $repo->getPackages((int)$orderNumber);        
        
        $view = $this->view($items, 200);
        
        return $this->handleView($view);
        
    }
    
}