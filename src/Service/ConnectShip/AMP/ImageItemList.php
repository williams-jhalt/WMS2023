<?php

namespace App\Service\ConnectShip\AMP;

class ImageItemList {

    /**
     * @var base64Binary[] $imageOutput
     */
    protected $imageOutput = null;

    /**
     * @var string[] $imageFile
     */
    protected $imageFile = null;

    public function __construct() {
        
    }

    /**
     * @return base64Binary[]
     */
    public function getImageOutput() {
        return $this->imageOutput;
    }

    /**
     * @param base64Binary[] $imageOutput
     * @return \App\Service\ConnectShip\AMP\ImageItemList
     */
    public function setImageOutput(array $imageOutput = null) {
        $this->imageOutput = $imageOutput;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getImageFile() {
        return $this->imageFile;
    }

    /**
     * @param string[] $imageFile
     * @return \App\Service\ConnectShip\AMP\ImageItemList
     */
    public function setImageFile(array $imageFile = null) {
        $this->imageFile = $imageFile;
        return $this;
    }

}
