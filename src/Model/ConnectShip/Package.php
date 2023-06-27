<?php

namespace App\Model\ConnectShip;

class Package {

    private $height;
    private $length;
    private $weight;
    private $width;
    private $freightCharge;
    private $handlingFee;
    private $fuelSurcharge;
    private $dimUnit;
    private $consigneePostalCode;
    private $consigneeState;
    private $consigneeCountry;
    private $shippingMethod;
    private $shipDate;

    public function getShipDate() {
        return $this->shipDate;
    }

    public function setShipDate($shipDate) {
        $this->shipDate = $shipDate;
        return $this;
    }

    public function getShippingMethod() {
        return $this->shippingMethod;
    }

    public function setShippingMethod($shippingMethod) {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    public function getConsigneePostalCode() {
        return $this->consigneePostalCode;
    }

    public function setConsigneePostalCode($consigneePostalCode) {
        $this->consigneePostalCode = $consigneePostalCode;
        return $this;
    }

    public function getDimUnit() {
        return $this->dimUnit;
    }

    public function setDimUnit($dimUnit) {
        $this->dimUnit = $dimUnit;
        return $this;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getLength() {
        return $this->length;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getFreightCharge() {
        return $this->freightCharge;
    }

    public function getHandlingFee() {
        return $this->handlingFee;
    }

    public function getFuelSurcharge() {
        return $this->fuelSurcharge;
    }

    public function setHeight($height) {
        $this->height = $height;
        return $this;
    }

    public function setLength($length) {
        $this->length = $length;
        return $this;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
        return $this;
    }

    public function setWidth($width) {
        $this->width = $width;
        return $this;
    }

    public function setFreightCharge($freightCharge) {
        $this->freightCharge = $freightCharge;
        return $this;
    }

    public function setHandlingFee($handlingFee) {
        $this->handlingFee = $handlingFee;
        return $this;
    }

    public function setFuelSurcharge($fuelSurcharge) {
        $this->fuelSurcharge = $fuelSurcharge;
        return $this;
    }

    public function getConsigneeState() {
        return $this->consigneeState;
    }

    public function getConsigneeCountry() {
        return $this->consigneeCountry;
    }

    public function setConsigneeState($consigneeState) {
        $this->consigneeState = $consigneeState;
        return $this;
    }

    public function setConsigneeCountry($consigneeCountry) {
        $this->consigneeCountry = $consigneeCountry;
        return $this;
    }

}
