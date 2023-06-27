<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class Order {

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $webOrderNumber;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $customerPurchaseOrder;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $customerNumber;

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
     * @JMS\Type("string")
     * @var string
     */
    protected $shipViaCode;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $residential = 'Y';

    /**
     * @JMS\Type("array<App\Model\Erp\OrderItem>")
     * @var OrderItem[]
     */
    protected $items;

    /**
     * 
     * @return string
     */
    public function getWebOrderNumber() {
        return $this->webOrderNumber;
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
    public function getWarehouse() {
        return $this->warehouse;
    }

    /**
     * 
     * @return OrderItem[]
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * 
     * @param string $webOrderNumber
     * @return Order
     */
    public function setWebOrderNumber($webOrderNumber) {
        $this->webOrderNumber = $webOrderNumber;
        return $this;
    }

    /**
     * 
     * @param string $customerNumber
     * @return Order
     */
    public function setCustomerNumber($customerNumber) {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    /**
     * 
     * @param string $shipToName
     * @return Order
     */
    public function setShipToName($shipToName) {
        $this->shipToName = $shipToName;
        return $this;
    }

    /**
     * 
     * @param string $shipToAddress1
     * @return Order
     */
    public function setShipToAddress1($shipToAddress1) {
        $this->shipToAddress1 = $shipToAddress1;
        return $this;
    }

    /**
     * 
     * @param string $shipToAddress2
     * @return Order
     */
    public function setShipToAddress2($shipToAddress2) {
        $this->shipToAddress2 = $shipToAddress2;
        return $this;
    }

    /**
     * 
     * @param string $shipToAddress3
     * @return Order
     */
    public function setShipToAddress3($shipToAddress3) {
        $this->shipToAddress3 = $shipToAddress3;
        return $this;
    }

    /**
     * 
     * @param string $shipToCity
     * @return Order
     */
    public function setShipToCity($shipToCity) {
        $this->shipToCity = $shipToCity;
        return $this;
    }

    /**
     * 
     * @param string $shipToState
     * @return Order
     */
    public function setShipToState($shipToState) {
        $this->shipToState = $shipToState;
        return $this;
    }

    /**
     * 
     * @param string $shipToZip
     * @return Order
     */
    public function setShipToZip($shipToZip) {
        $this->shipToZip = $shipToZip;
        return $this;
    }

    /**
     * 
     * @param string $warehouse
     * @return Order
     */
    public function setWarehouse($warehouse) {
        $this->warehouse = $warehouse;
        return $this;
    }

    /**
     * 
     * @param OrderItem[] $items
     * @return Order
     */
    public function setItems(array $items) {
        $this->items = $items;
        return $this;
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
    public function getShipViaCode() {
        return $this->shipViaCode;
    }

    /**
     * 
     * @param string $shipToCountry
     * @return Order
     */
    public function setShipToCountry($shipToCountry) {
        $this->shipToCountry = $shipToCountry;
        return $this;
    }

    /**
     * 
     * @param string $shipViaCode
     * @return Order
     */
    public function setShipViaCode($shipViaCode) {
        $this->shipViaCode = $shipViaCode;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getResidential() {
        return $this->residential;
    }

    /**
     * 
     * @param string $residential
     * @return Order
     */
    public function setResidential($residential) {
        $this->residential = $residential;
        return $this;
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
     * @param string $shipToPhone
     * @return Order
     */
    public function setShipToPhone($shipToPhone) {
        $this->shipToPhone = $shipToPhone;
        return $this;
    }

    /**
     * 
     * @param string $shipToEmail
     * @return Order
     */
    public function setShipToEmail($shipToEmail) {
        $this->shipToEmail = $shipToEmail;
        return $this;
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
     * @param string $customerPurchaseOrder
     * @return Order
     */
    public function setCustomerPurchaseOrder($customerPurchaseOrder) {
        $this->customerPurchaseOrder = $customerPurchaseOrder;
        return $this;
    }

}
