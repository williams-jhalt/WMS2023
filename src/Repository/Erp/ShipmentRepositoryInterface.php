<?php

namespace App\Repository\Erp;

use DateTime;
use App\Model\Erp\Shipment;
use App\Model\Erp\ShipmentCollection;
use App\Model\Erp\ShipmentItemCollection;
use App\Model\Erp\ShipmentPackage;
use App\Model\Erp\ShipmentPackageCollection;

interface ShipmentRepositoryInterface {

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * 
     * @return ShipmentCollection
     */
    public function findAll($limit = 1000, $offset = 0);

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * 
     * @return ShipmentCollection
     */
    public function findOpen($limit = 1000, $offset = 0);
    
    /**
     * 
     * @param integer $orderNumber
     * 
     * @return ShipmentCollection
     */
    public function findByOrderNumber($orderNumber);
    
    /**
     * 
     * @param integer $orderNumber
     * @param integer $recordSequence
     * 
     * @return Shipment
     */
    public function get($orderNumber, $recordSequence = 1);
    
    /**
     * 
     * @param integer $orderNumber
     * @param integer $recordSequence
     * 
     * @return ShipmentItemCollection
     */
    public function getItems($orderNumber, $recordSequence = 1);
    
    /**
     * 
     * @param integer $orderNumber
     * 
     * @return ShipmentPackageCollection
     */
    public function getPackages($orderNumber);
    
    /**
     * 
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param int $limit
     * @param int $offset
     * @return ShipmentCollection
     */
    public function findByShippingDate(DateTime $startDate, DateTime $endDate, $limit = 1000, $offset = 0);
    
    /**
     * Loads shipping information for an order
     * 
     * @param string $ucc
     * @return Shipment
     */
    public function getByUcc($ucc);
    
    /**
     * Submits package information after shipment
     * 
     * @param ShipmentPackage $shipmentPackage
     */
    public function submitShipmentPackage($shipmentPackage);
    
}
