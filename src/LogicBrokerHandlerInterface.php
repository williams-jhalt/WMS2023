<?php

namespace App;

use App\Adapter\LogicBroker\AbstractInventoryAdapter;
use App\Entity\LogicBrokerOrderStatus as OrderStatus;
use App\Model\LogicBroker\Invoice;
use App\Model\LogicBroker\Order;
use App\Model\LogicBroker\Shipment;

/**
 * Implement this class to create a handler for submitting and retrieving
 * order information
 */
interface LogicBrokerHandlerInterface {

    /**
     * Submit an order to the ordering system and return  
     * the order number
     * 
     * @param Order $order
     * @param string $customerNumber
     * @return string
     */
    public function submitOrder(Order $order, $customerNumber);
    
    /**
     * Retrieve an order number if order has been entered into ERP
     * 
     * @param OrderStatus $orderStatus
     * @return string
     */
    public function retrieveOrderNumber(OrderStatus $orderStatus);
    
    /**
     * Retrieve invoices for an order
     * 
     * @param OrderStatus $orderStatus
     * @return Invoice[]
     */
    public function getInvoices(OrderStatus $orderStatus);
    
    /**
     * Retrieve shipments for an order
     * 
     * @param OrderStatus $orderStatus
     * @return Shipment[]
     */
    public function getShipments(OrderStatus $orderStatus);
    
    /**
     * 
     * @param AbstractInventoryAdapter $adapter
     */
    public function writeInventory(AbstractInventoryAdapter $adapter);
    
}