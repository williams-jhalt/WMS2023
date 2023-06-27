<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use ErpBundle\Model\ShipmentCollection;
use ErpBundle\Service\ErpService;

class ErpShipmentsController extends AbstractFOSRestController {
    
    /**
     * 
     * @return ErpService
     */
    private function getErpService() {        
        return $this->get('williams_erp.service');
    }
    
    /**
     * 
     * @param int $orderNumber
     * @return View
     */
    public function getShipmentsAction($orderNumber) {

        $repo = $this->getErpService()->getShipmentRepository();
        
        $shipments = $repo->findByOrderNumber($orderNumber);
        
        $view = $this->view($shipments, 200);
        
        return $this->handleView($view);
        
    }
    
    /**
     * @param int $orderNumber
     * @param int $recordSequence
     * @return View
     */
    public function getShipmentAction($orderNumber, $recordSequence) {
                
        $repo = $this->getErpService()->getShipmentRepository();
        
        $shipment = $repo->get((int)$orderNumber, (int)$recordSequence);
        
        $view = $this->view($shipment, 200);
        
        return $this->handleView($view);
    }
    
}