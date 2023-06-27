<?php

namespace App\Model\Wholesale;

class ProductType {

    private $id;
    private $code;
    private $name;
    private $description;
    private $maxDiscountRate;
    private $video;
    private $active;

    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getMaxDiscountRate() {
        return $this->maxDiscountRate;
    }

    public function getVideo() {
        return $this->video;
    }

    public function getActive() {
        return $this->active;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setCode($code) {
        $this->code = $code;
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

    public function setMaxDiscountRate($maxDiscountRate) {
        $this->maxDiscountRate = $maxDiscountRate;
        return $this;
    }

    public function setVideo($video) {
        $this->video = $video;
        return $this;
    }

    public function setActive($active) {
        $this->active = $active;
        return $this;
    }

}
