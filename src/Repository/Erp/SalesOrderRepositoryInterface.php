<?php

namespace App\Repository\Erp;

use DateTime;
use App\Model\Erp\Order;
use App\Model\Erp\SalesOrder;
use App\Model\Erp\SalesOrderCollection;
use App\Model\Erp\SalesOrderItemCollection;

interface SalesOrderRepositoryInterface {

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * 
     * @return SalesOrderCollection
     */
    public function findAll($limit = 100, $offset = 0);
    
    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * 
     * @return SalesOrderCollection
     */
    public function findOpen($limit = 100, $offset = 0);
    
    /**
     * 
     * @param string $searchTerms
     * 
     * @return SalesOrderCollection
     */
    public function findByTextSearch($searchTerms);
    
    /**
     * 
     * @param integer $orderNumber
     * 
     * @return SalesOrder
     */
    public function get($orderNumber);
    
    /**
     * 
     * @param string $webReferenceNumber
     * @param string $customerNumber
     * 
     * @return SalesOrder
     */
    public function getByWebReferenceNumberAndCustomerNumber($webReferenceNumber, $customerNumber);
    
    /**
     * 
     * @param integer $orderNumber
     * 
     * @return SalesOrderItemCollection
     */
    public function getItems($orderNumber);
    
    /**
     * 
     * @param Order $order
     * 
     * @return boolean 
     */
    public function submitOrder(Order $order);
    
    /**
     * 
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param integer $limit
     * @param integer $offset
     * 
     * @return SalesOrderCollection
     */
    public function findByOrderDate(DateTime $startDate, DateTime $endDate, $limit = 100, $offset = 0);
    
    /**
     * 
     * @param string $customerNumber
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param integer $limit
     * @param integer $offset
     * 
     * @return SalesOrderCollection
     */
    public function findByCustomerNumberAndOrderDate($customerNumber, DateTime $startDate, DateTime $endDate, $limit = 100, $offset = 0);

}
