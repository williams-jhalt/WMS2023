<?php

namespace App\Model\Erp;

use DateTime;
use JMS\Serializer\Annotation as JMS;

class Product {

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $itemNumber;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $name;

    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $wholesalePrice;

    /**
     * @JMS\Type("DateTime")
     * @var DateTime
     */
    protected $releaseDate;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $binLocation;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $manufacturerCode;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $productTypeCode;

    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $quantityOnHand;

    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $quantityCommitted;

    /**
     * @JMS\Type("DateTime")
     * @var DateTime
     */
    protected $createdOn;

    /**
     * @JMS\Type("boolean")
     * @var boolean
     */
    protected $deleted;

    /**
     * @JMS\Type("boolean")
     * @var boolean
     */
    protected $webItem;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $warehouse;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $unitOfMeasure;

    /**
     *
     * @JMS\Type("string")
     * @var string 
     */
    protected $barcode;

    /**
     * 
     * @return string
     */
    public function getItemNumber() {
        return $this->itemNumber;
    }

    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @return double
     */
    public function getWholesalePrice() {
        return $this->wholesalePrice;
    }

    /**
     * 
     * @return DateTime
     */
    public function getReleaseDate() {
        return $this->releaseDate;
    }

    /**
     * 
     * @return string
     */
    public function getBinLocation() {
        return $this->binLocation;
    }

    /**
     * 
     * @return string
     */
    public function getManufacturerCode() {
        return $this->manufacturerCode;
    }

    /**
     * 
     * @return string
     */
    public function getProductTypeCode() {
        return $this->productTypeCode;
    }

    /**
     * 
     * @param string $itemNumber
     * @return Product
     */
    public function setItemNumber($itemNumber) {
        $this->itemNumber = $itemNumber;
        return $this;
    }

    /**
     * 
     * @param string $name
     * @return Product
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * 
     * @param double $wholesalePrice
     * @return Product
     */
    public function setWholesalePrice($wholesalePrice) {
        $this->wholesalePrice = $wholesalePrice;
        return $this;
    }

    /**
     * 
     * @param DateTime $releaseDate
     * @return Product
     */
    public function setReleaseDate($releaseDate) {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * 
     * @param string $binLocation
     * @return Product
     */
    public function setBinLocation($binLocation) {
        $this->binLocation = $binLocation;
        return $this;
    }

    /**
     * 
     * @param string $manufacturerCode
     * @return Product
     */
    public function setManufacturerCode($manufacturerCode) {
        $this->manufacturerCode = $manufacturerCode;
        return $this;
    }

    /**
     * 
     * @param string $productTypeCode
     * @return Product
     */
    public function setProductTypeCode($productTypeCode) {
        $this->productTypeCode = $productTypeCode;
        return $this;
    }

    /**
     * 
     * @return integer
     */
    public function getQuantityOnHand() {
        return $this->quantityOnHand;
    }

    /**
     * 
     * @return integer
     */
    public function getQuantityCommitted() {
        return $this->quantityCommitted;
    }

    /**
     * 
     * @param integer $quantityOnHand
     * @return Product
     */
    public function setQuantityOnHand($quantityOnHand) {
        $this->quantityOnHand = $quantityOnHand;
        return $this;
    }

    /**
     * 
     * @param integer $quantityCommitted
     * @return Product
     */
    public function setQuantityCommitted($quantityCommitted) {
        $this->quantityCommitted = $quantityCommitted;
        return $this;
    }

    /**
     * 
     * @return DateTime
     */
    public function getCreatedOn() {
        return $this->createdOn;
    }

    /**
     * 
     * @param DateTime $createdOn
     * @return Product
     */
    public function setCreatedOn($createdOn) {
        $this->createdOn = $createdOn;
        return $this;
    }

    /**
     * 
     * @return boolean
     */
    public function getDeleted() {
        return $this->deleted;
    }

    /**
     * 
     * @return boolean
     */
    public function getWebItem() {
        return $this->webItem;
    }

    /**
     * 
     * @param boolean $deleted
     * @return Product
     */
    public function setDeleted($deleted) {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * 
     * @param boolean $webItem
     * @return Product
     */
    public function setWebItem($webItem) {
        $this->webItem = $webItem;
        return $this;
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
     * @return string
     */
    public function getUnitOfMeasure() {
        return $this->unitOfMeasure;
    }

    /**
     * 
     * @param string $warehouse
     * @return Product
     */
    public function setWarehouse($warehouse) {
        $this->warehouse = $warehouse;
        return $this;
    }

    /**
     * 
     * @param string $unitOfMeasure
     * @return Product
     */
    public function setUnitOfMeasure($unitOfMeasure) {
        $this->unitOfMeasure = $unitOfMeasure;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getBarcode() {
        return $this->barcode;
    }

    /**
     * 
     * @param string $barcode
     * @return Product
     */
    public function setBarcode($barcode) {
        $this->barcode = $barcode;
        return $this;
    }

}
