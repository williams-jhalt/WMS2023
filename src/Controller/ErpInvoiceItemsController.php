<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use App\Model\Erp\InvoiceItemCollection;
use App\Service\ErpService;

class ErpInvoiceItemsController extends AbstractFOSRestController {
    
    /**
     * 
     * @return ErpService
     */
    private function getErpService() {        
        return $this->get('williams_erp.service');
    }
    
    /**
     * @param int $orderNumber
     * @param int $recordSequence
     * @return View
     */
    public function getItemsAction($orderNumber, $recordSequence) {
                        
        $repo = $this->getErpService()->getInvoiceRepository();
        
        $items = $repo->getItems((int)$orderNumber, (int)$recordSequence);
        
        $view = $this->view($items, 200);
        
        return $this->handleView($view);
        
    }
    
}