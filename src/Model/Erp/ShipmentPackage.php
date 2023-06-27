<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentPackage {

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $trackingNumber;

    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $freightCost;

    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $shippingWeight;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $shipViaCode;

    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $packageHeight;

    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $packageLength;

    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $packageWidth;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $ucc;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $manifestCarrier;

    /**
     * @JMS\Type("array<App\Model\Erp\ShipmentPackageItem>")
     * @var ShipmentPackageItem[]
     */
    protected $items;

    /**
     * 
     * @return string
     */
    public function getTrackingNumber() {
        return $this->trackingNumber;
    }

    /**
     * 
     * @return double
     */
    public function getFreightCost() {
        return $this->freightCost;
    }

    /**
     * 
     * @param string $trackingNumber
     * @return ShipmentPackage
     */
    public function setTrackingNumber($trackingNumber) {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * 
     * @param double $freightCost
     * @return ShipmentPackage
     */
    public function setFreightCost($freightCost) {
        $this->freightCost = $freightCost;
        return $this;
    }

    /**
     * 
     * @return double
     */
    public function getShippingWeight() {
        return $this->shippingWeight;
    }

    /**
     * 
     * @param double $shippingWeight
     * @return ShipmentPackage
     */
    public function setShippingWeight($shippingWeight) {
        $this->shippingWeight = $shippingWeight;
        return $this;
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
     * @return double
     */
    public function getPackageHeight() {
        return $this->packageHeight;
    }

    /**
     * 
     * @return double
     */
    public function getPackageLength() {
        return $this->packageLength;
    }

    /**
     * 
     * @return double
     */
    public function getPackageWidth() {
        return $this->packageWidth;
    }

    /**
     * 
     * @param string $shipViaCode
     * @return ShipmentPackage
     */
    public function setShipViaCode($shipViaCode) {
        $this->shipViaCode = $shipViaCode;
        return $this;
    }

    /**
     * 
     * @param double $packageHeight
     * @return ShipmentPackage
     */
    public function setPackageHeight($packageHeight) {
        $this->packageHeight = $packageHeight;
        return $this;
    }

    /**
     * 
     * @param double $packageLength
     * @return ShipmentPackage
     */
    public function setPackageLength($packageLength) {
        $this->packageLength = $packageLength;
        return $this;
    }

    /**
     * 
     * @param double $packageWidth
     * @return ShipmentPackage
     */
    public function setPackageWidth($packageWidth) {
        $this->packageWidth = $packageWidth;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getUcc() {
        return $this->ucc;
    }

    /**
     * 
     * @param string $ucc
     * @return ShipmentPackage
     */
    public function setUcc($ucc) {
        $this->ucc = $ucc;
        return $this;
    }

    /**
     * 
     * @return ShipmentPackageItem[]
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * 
     * @param ShipmentPackageItem[] $items
     * @return ShipmentPackage
     */
    public function setItems($items) {
        $this->items = $items;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getManifestCarrier() {
        return $this->manifestCarrier;
    }

    /**
     * 
     * @param string $manifestCarrier
     * @return ShipmentPackage
     */
    public function setManifestCarrier($manifestCarrier) {
        $this->manifestCarrier = $manifestCarrier;
        return $this;
    }

}
