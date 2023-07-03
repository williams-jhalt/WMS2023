<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use App\Model\Erp\ProductCollection;
use App\Service\ErpService;

class ErpProductsController extends AbstractFOSRestController {
    
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
     * @Rest\QueryParam(name="committed", description="Optional return committed items")
     * 
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getProductsAction(ParamFetcher $paramFetcher) {
                
        $limit = $paramFetcher->get('limit');
        $offset = $paramFetcher->get('offset');
        $searchTerms = $paramFetcher->get('search');
        $committed = $paramFetcher->get('committed', false);

        $productRepo = $this->getErpService()->getProductRepository();
        
        if (!empty($searchTerms)) {
            $products = $productRepo->findByTextSearch($searchTerms, $limit, $offset);
        } elseif($committed) {
            $products = $productRepo->findCommittedItems($limit, $offset);
        } else {
            $products = $productRepo->findAll($limit, $offset);
        }
        
        $view = $this->view($products, 200);
        
        return $this->handleView($view);
        
    }
    
    public function getProductAction($itemNumber) {
        $productRepo = $this->getErpService()->getProductRepository();
        
        $product = $productRepo->getByItemNumber($itemNumber);
        
        $view = $this->view($product, 200);
        
        return $this->handleView($view);
    }
    
}