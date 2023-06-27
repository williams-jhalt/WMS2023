<?php

namespace App\Service\ConnectShip\AMP;

class IdentityList {

    /**
     * @var Identity[] $item
     */
    protected $item = null;

    public function __construct() {
        
    }

    /**
     * @return Identity[]
     */
    public function getItem() {
        return $this->item;
    }

    /**
     * @param Identity[] $item
     * @return \App\Service\ConnectShip\AMP\IdentityList
     */
    public function setItem(array $item = null) {
        $this->item = $item;
        return $this;
    }

}
