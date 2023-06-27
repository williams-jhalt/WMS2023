<?php

namespace App\Model\Erp;

use DateTime;
use JMS\Serializer\Annotation as JMS;

class SalesOrder {

    
    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $orderNumber;
    
    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $recordSequence;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToName;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToAddress1;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToAddress2;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToAddress3;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToCity;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToState;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToZip;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToCountry;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToPhone;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipToEmail;
    
    /**
     * @JMS\Type("DateTime")
     * @var DateTime
     */
    protected $orderDate;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipViaCode;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $customerNumber;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $webReferenceNumber;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $customerPurchaseOrder;
    
    /**
     * @JMS\Type("boolean")
     * @var boolean
     */
    protected $open;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $status;
    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $sourceCode;

    /**
     * 
     * @return integer
     */
    public function getOrderNumber() {
        return $this->orderNumber;
    }

    /**
     * 
     * @return integer
     */
    public function getRecordSequence() {
        return $this->recordSequence;
    }

    /**
     * 
     * @return string
     */
    public function getShipToName() {
        return $this->shipToName;
    }

    /**
     * 
     * @return string
     */
    public function getShipToAddress1() {
        return $this->shipToAddress1;
    }

    /**
     * 
     * @return string
     */
    public function getShipToAddress2() {
        return $this->shipToAddress2;
    }

    /**
     * 
     * @return string
     */
    public function getShipToAddress3() {
        return $this->shipToAddress3;
    }

    /**
     * 
     * @return string
     */
    public function getShipToCity() {
        return $this->shipToCity;
    }

    /**
     * 
     * @return string
     */
    public function getShipToState() {
        return $this->shipToState;
    }

    /**
     * 
     * @return string
     */
    public function getShipToZip() {
        return $this->shipToZip;
    }

    /**
     * 
     * @return string
     */
    public function getShipToCountry() {
        return $this->shipToCountry;
    }

    /**
     * 
     * @return string
     */
    public function getShipToPhone() {
        return $this->shipToPhone;
    }

    /**
     * 
     * @return string
     */
    public function getShipToEmail() {
        return $this->shipToEmail;
    }

    /**
     * 
     * @return DateTime
     */
    public function getOrderDate() {
        return $this->orderDate;
    }

    /**
     * 
     * @return string
     */
    public function getShipViaCode() {
        return $this->shipViaCode;
    }

    /**
     * 
     * @return string
     */
    public function getCustomerNumber() {
        return $this->customerNumber;
    }

    /**
     * 
     * @return string
     */
    public function getWebReferenceNumber() {
        return $this->webReferenceNumber;
    }

    /**
     * 
     * @return string
     */
    public function getCustomerPurchaseOrder() {
        return $this->customerPurchaseOrder;
    }

    /**
     * 
     * @return boolean
     */
    public function getOpen() {
        return $this->open;
    }

    /**
     * 
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * 
     * @param integer $orderNumber
     * @return SalesOrder
     */
    public function setOrderNumber($orderNumber) {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    /**
     * 
     * @param integer $recordSequence
     * @return SalesOrder
     */
    public function setRecordSequence($recordSequence) {
        $this->recordSequence = $recordSequence;
        return $this;
    }

    /**
     * 
     * @param string $shipToName
     * @return SalesOrder
     */
    public function setShipToName($shipToName) {
        $this->shipToName = $shipToName;
        return $this;
    }

    /**
     * 
     * @param string $shipToAddress1
     * @return SalesOrder
     */
    public function setShipToAddress1($shipToAddress1) {
        $this->shipToAddress1 = $shipToAddress1;
        return $this;
    }

    /**
     * 
     * @param string $shipToAddress2
     * @return SalesOrder
     */
    public function setShipToAddress2($shipToAddress2) {
        $this->shipToAddress2 = $shipToAddress2;
        return $this;
    }

    /**
     * 
     * @param string $shipToAddress3
     * @return SalesOrder
     */
    public function setShipToAddress3($shipToAddress3) {
        $this->shipToAddress3 = $shipToAddress3;
        return $this;
    }

    /**
     * 
     * @param string $shipToCity
     * @return SalesOrder
     */
    public function setShipToCity($shipToCity) {
        $this->shipToCity = $shipToCity;
        return $this;
    }

    /**
     * 
     * @param string $shipToState
     * @return SalesOrder
     */
    public function setShipToState($shipToState) {
        $this->shipToState = $shipToState;
        return $this;
    }

    /**
     * 
     * @param string $shipToZip
     * @return SalesOrder
     */
    public function setShipToZip($shipToZip) {
        $this->shipToZip = $shipToZip;
        return $this;
    }

    /**
     * 
     * @param string $shipToCountry
     * @return SalesOrder
     */
    public function setShipToCountry($shipToCountry) {
        $this->shipToCountry = $shipToCountry;
        return $this;
    }

    /**
     * 
     * @param string $shipToPhone
     * @return SalesOrder
     */
    public function setShipToPhone($shipToPhone) {
        $this->shipToPhone = $shipToPhone;
        return $this;
    }

    /**
     * 
     * @param string $shipToEmail
     * @return SalesOrder
     */
    public function setShipToEmail($shipToEmail) {
        $this->shipToEmail = $shipToEmail;
        return $this;
    }

    /**
     * 
     * @param DateTime $orderDate
     * @return SalesOrder
     */
    public function setOrderDate($orderDate) {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * 
     * @param string $shipViaCode
     * @return SalesOrder
     */
    public function setShipViaCode($shipViaCode) {
        $this->shipViaCode = $shipViaCode;
        return $this;
    }

    /**
     * 
     * @param string $customerNumber
     * @return SalesOrder
     */
    public function setCustomerNumber($customerNumber) {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    /**
     * 
     * @param string $webReferenceNumber
     * @return SalesOrder
     */
    public function setWebReferenceNumber($webReferenceNumber) {
        $this->webReferenceNumber = $webReferenceNumber;
        return $this;
    }

    /**
     * 
     * @param string $customerPurchaseOrder
     * @return SalesOrder
     */
    public function setCustomerPurchaseOrder($customerPurchaseOrder) {
        $this->customerPurchaseOrder = $customerPurchaseOrder;
        return $this;
    }

    /**
     * 
     * @param boolean $open
     * @return SalesOrder
     */
    public function setOpen($open) {
        $this->open = $open;
        return $this;
    }

    /**
     * 
     * @param string $status
     * @return SalesOrder
     */
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getSourceCode() {
        return $this->sourceCode;
    }

    /**
     * 
     * @param string $sourceCode
     * @return SalesOrder
     */
    public function setSourceCode($sourceCode) {
        $this->sourceCode = $sourceCode;
        return $this;
    }



}
