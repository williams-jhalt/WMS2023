<?php

namespace App\Repository\Erp;

use App\Model\Erp\Customer;
use App\Model\Erp\CustomerCollection;

interface CustomerRepositoryInterface {

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * 
     * @return CustomerCollection
     */
    public function findAll($limit = 1000, $offset = 0, $company = "");
    
    /**
     * 
     * @param string $searchTerms
     * @param integer $limit
     * @param integer $offset
     * 
     * @return CustomerCollection
     */
    public function findByTextSearch($searchTerms, $limit = 1000, $offset = 0, $company = "");
    
    /**
     * 
     * @param string $customerNumber
     * 
     * @return Customer
     */
    public function getByCustomerNumber($customerNumber, $company = "");

}
