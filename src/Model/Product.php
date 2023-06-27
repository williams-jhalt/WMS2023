<?php

namespace App\Model;

use App\Model\Wholesale\ProductImage;

class Product extends \App\Model\Erp\Product {

    protected $description;
    protected $keywords;
    protected $active;
    protected $video;
    protected $onSale;
    protected $height;
    protected $length;
    protected $width;
    protected $diameter;
    protected $weight;
    protected $color;
    protected $material;
    protected $discountable;
    protected $maxDiscountRate;
    protected $saleable;
    protected $images;
    
    public function __construct() {
        $this->images = array();        
    }

    public function getDescription() {
        return $this->description;
    }

    public function getKeywords() {
        return $this->keywords;
    }

    public function getActive() {
        return $this->active;
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

    public function getDiscountable() {
        return $this->discountable;
    }

    public function getMaxDiscountRate() {
        return $this->maxDiscountRate;
    }

    public function getSaleable() {
        return $this->saleable;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
        return $this;
    }

    public function setActive($active) {
        $this->active = $active;
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

    public function setDiscountable($discountable) {
        $this->discountable = $discountable;
        return $this;
    }

    public function setMaxDiscountRate($maxDiscountRate) {
        $this->maxDiscountRate = $maxDiscountRate;
        return $this;
    }

    public function setSaleable($saleable) {
        $this->saleable = $saleable;
        return $this;
    }

    /**
     * @return ProductImage[]
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * 
     * @param array $images
     * @return Product
     */
    public function setImages(array $images) {
        $this->images = $images;
        return $this;
    }

}
