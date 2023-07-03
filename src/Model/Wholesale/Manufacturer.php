<?php

namespace App\Model\Wholesale;

class Manufacturer {

    private $id;
    private $code;
    private $name;
    private $active = false;
    private $video = false;

    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getName() {
        return $this->name;
    }

    public function getActive() {
        return $this->active;
    }

    public function getVideo() {
        return $this->video;
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

    public function setActive($active) {
        $this->active = $active;
        return $this;
    }

    public function setVideo($video) {
        $this->video = $video;
        return $this;
    }

}
