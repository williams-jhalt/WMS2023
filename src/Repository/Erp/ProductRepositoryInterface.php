<?php

namespace App\Repository\Erp;

use App\Model\Erp\Product;
use App\Model\Erp\ProductCollection;

interface ProductRepositoryInterface {

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * 
     * @return ProductCollection
     */
    public function findAll($limit = 1000, $offset = 0, $company = null, $warehouse = null);
    
    /**
     * 
     * @param string $searchTerms
     * @param integer $limit
     * @param integer $offset
     * 
     * @return ProductCollection
     */
    public function findByTextSearch($searchTerms, $limit = 1000, $offset = 0, $company = null, $warehouse = null);
    
    /**
     * 
     * @param string $itemNumber
     * 
     * @return Product
     */
    public function getByItemNumber($itemNumber, $company = null, $warehouse = null);
    
    /**
     * @param integer $limit
     * @param integer $offset
     * 
     * @return ProductCollection
     */
    public function findCommittedItems($limit = 1000, $offset = 0, $company = null, $warehouse = null);

}
