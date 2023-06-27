<?php

namespace App\Model\Wholesale;

class Product {

    private $id;
    private $sku;
    private $name;
    private $description;
    private $keywords;
    private $price;
    private $active;
    private $manufacturerId;
    private $barcode;
    private $sockQuantity;
    private $reorderQuantity;
    private $video;
    private $onSale;
    private $height;
    private $length;
    private $width;
    private $diameter;
    private $weight;
    private $color;
    private $material;
    private $releaseDate;
    private $createdOn;
    private $updatedOn;
    private $discountable;
    private $maxDiscountRate;
    private $typeId;
    private $saleable;
    private $brand;
    private $productLength;
    private $insertableLength;
    private $realistic;
    private $balls;
    private $suctionCup;
    private $harness;
    private $vibrating;
    private $doubleEnded;
    private $circumference;

    public function getId() {
        return $this->id;
    }

    public function getSku() {
        return $this->sku;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getKeywords() {
        return $this->keywords;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getActive() {
        return $this->active;
    }

    public function getManufacturerId() {
        return $this->manufacturerId;
    }

    public function getBarcode() {
        return $this->barcode;
    }

    public function getSockQuantity() {
        return $this->sockQuantity;
    }

    public function getReorderQuantity() {
        return $this->reorderQuantity;
    }

    public function getVideo() {
        return $this->video;
    }

    public function getOnSale() {
        return $this->onSale;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getLength() {
        return $this->length;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getDiameter() {
        return $this->diameter;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getColor() {
        return $this->color;
    }

    public function getMaterial() {
        return $this->material;
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function getCreatedOn() {
        return $this->createdOn;
    }

    public function getUpdatedOn() {
        return $this->updatedOn;
    }

    public function getDiscountable() {
        return $this->discountable;
    }

    public function getMaxDiscountRate() {
        return $this->maxDiscountRate;
    }

    public function getTypeId() {
        return $this->typeId;
    }

    public function getSaleable() {
        return $this->saleable;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setSku($sku) {
        $this->sku = $sku;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
        return $this;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function setActive($active) {
        $this->active = $active;
        return $this;
    }

    public function setManufacturerId($manufacturerId) {
        $this->manufacturerId = $manufacturerId;
        return $this;
    }

    public function setBarcode($barcode) {
        $this->barcode = $barcode;
        return $this;
    }

    public function setSockQuantity($sockQuantity) {
        $this->sockQuantity = $sockQuantity;
        return $this;
    }

    public function setReorderQuantity($reorderQuantity) {
        $this->reorderQuantity = $reorderQuantity;
        return $this;
    }

    public function setVideo($video) {
        $this->video = $video;
        return $this;
    }

    public function setOnSale($onSale) {
        $this->onSale = $onSale;
        return $this;
    }

    public function setHeight($height) {
        $this->height = $height;
        return $this;
    }

    public function setLength($length) {
        $this->length = $length;
        return $this;
    }

    public function setWidth($width) {
        $this->width = $width;
        return $this;
    }

    public function setDiameter($diameter) {
        $this->diameter = $diameter;
        return $this;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
        return $this;
    }

    public function setColor($color) {
        $this->color = $color;
        return $this;
    }

    public function setMaterial($material) {
        $this->material = $material;
        return $this;
    }

    public function setReleaseDate($releaseDate) {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    public function setCreatedOn($createdOn) {
        $this->createdOn = $createdOn;
        return $this;
    }

    public function setUpdatedOn($updatedOn) {
        $this->updatedOn = $updatedOn;
        return $this;
    }

    public function setDiscountable($discountable) {
        $this->discountable = $discountable;
        return $this;
    }

    public function setMaxDiscountRate($maxDiscountRate) {
        $this->maxDiscountRate = $maxDiscountRate;
        return $this;
    }

    public function setTypeId($typeId) {
        $this->typeId = $typeId;
        return $this;
    }

    public function setSaleable($saleable) {
        $this->saleable = $saleable;
        return $this;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function getProductLength() {
        return $this->productLength;
    }

    public function getInsertableLength() {
        return $this->insertableLength;
    }

    public function getRealistic() {
        return $this->realistic;
    }

    public function getBalls() {
        return $this->balls;
    }

    public function getSuctionCup() {
        return $this->suctionCup;
    }

    public function getHarness() {
        return $this->harness;
    }

    public function getVibrating() {
        return $this->vibrating;
    }

    public function getDoubleEnded() {
        return $this->doubleEnded;
    }

    public function getCircumference() {
        return $this->circumference;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
        return $this;
    }

    public function setProductLength($productLength) {
        $this->productLength = $productLength;
        return $this;
    }

    public function setInsertableLength($insertableLength) {
        $this->insertableLength = $insertableLength;
        return $this;
    }

    public function setRealistic($realistic) {
        $this->realistic = $realistic;
        return $this;
    }

    public function setBalls($balls) {
        $this->balls = $balls;
        return $this;
    }

    public function setSuctionCup($suctionCup) {
        $this->suctionCup = $suctionCup;
        return $this;
    }

    public function setHarness($harness) {
        $this->harness = $harness;
        return $this;
    }

    public function setVibrating($vibrating) {
        $this->vibrating = $vibrating;
        return $this;
    }

    public function setDoubleEnded($doubleEnded) {
        $this->doubleEnded = $doubleEnded;
        return $this;
    }

    public function setCircumference($circumference) {
        $this->circumference = $circumference;
        return $this;
    }

}
