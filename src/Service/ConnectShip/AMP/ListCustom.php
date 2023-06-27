<?php

namespace App\Service\ConnectShip\AMP;

class ListCustom extends CollectionBase {

    /**
     * @var anyType[] $item
     */
    protected $item = null;

    public function __construct() {
        
    }

    /**
     * @return anyType[]
     */
    public function getItem() {
        return $this->item;
    }

    /**
     * @param anyType[] $item
     * @return \App\Service\ConnectShip\AMP\List
     */
    public function setItem(array $item = null) {
        $this->item = $item;
        return $this;
    }

}
