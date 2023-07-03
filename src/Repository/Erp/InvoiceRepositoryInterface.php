<?php

namespace App\Repository\Erp;

use App\Model\Erp\Invoice;
use App\Model\Erp\InvoiceCollection;
use App\Model\Erp\InvoiceItemCollection;
use DateTime;

interface InvoiceRepositoryInterface {

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * 
     * @return InvoiceCollection
     */
    public function findAll($limit = 1000, $offset = 0);
    
    /**
     * 
     * @param string $customerNumber
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param boolean $consolidated
     * @param integer $limit
     * @param integer $offset
     * @return InvoiceCollection
     */
    public function findByCustomerAndDate(string $customerNumber, DateTime $startDate = null, DateTime $endDate = null, bool $consolidated = false, int $limit = 1000, int $offset = 0);
    
    /**
     * 
     * @param integer $orderNumber
     * 
     * @return InvoiceCollection
     */
    public function findByOrderNumber($orderNumber);
    
    /**
     * 
     * @param integer $orderNumber
     * @param integer $recordSequence
     * 
     * @return Invoice
     */
    public function get($orderNumber, $recordSequence = 1);
    
    /**
     * 
     * @param integer $orderNumber
     * @param integer $recordSequence
     * 
     * @return InvoiceItemCollection
     */
    public function getItems($orderNumber, $recordSequence = 1);

}
