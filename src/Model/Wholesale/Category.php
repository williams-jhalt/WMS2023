<?php

namespace App\Model\Wholesale;

class Category {

    private $id;
    private $code;
    private $name;
    private $description;
    private $parentId;
    private $active;
    private $video;
    private $lft;
    private $rgt;

    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getName() {
        return $this->name;
    }

    public function getParentId() {
        return $this->parentId;
    }

    public function getActive() {
        return $this->active;
    }

    public function getVideo() {
        return $this->video;
    }

    public function getLft() {
        return $this->lft;
    }

    public function getRgt() {
        return $this->rgt;
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

    public function setParentId($parentId) {
        $this->parentId = $parentId;
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

    public function setLft($lft) {
        $this->lft = $lft;
        return $this;
    }

    public function setRgt($rgt) {
        $this->rgt = $rgt;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

}
