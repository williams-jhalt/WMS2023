<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use ErpBundle\Model\InvoiceCollection;
use ErpBundle\Service\ErpService;

class InvoicesController extends AbstractFOSRestController {
    
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
    public function getInvoicesAction($orderNumber) {

        $repo = $this->getErpService()->getInvoiceRepository();
        
        $invoices = $repo->findByOrderNumber($orderNumber);
        
        $view = $this->view($invoices, 200);
        
        return $this->handleView($view);
        
    }
    
    /**
     * @param int $orderNumber
     * @param int $recordSequence
     * @return View
     */
    public function getInvoiceAction($orderNumber, $recordSequence) {
                
        $repo = $this->getErpService()->getInvoiceRepository();
        
        $invoice = $repo->get((int)$orderNumber, (int)$recordSequence);
        
        $view = $this->view($invoice, 200);
        
        return $this->handleView($view);
    }
    
}