<?php

namespace App\Service\ConnectShip\AMP;

class Dictionary extends CollectionBase {

    /**
     * @var DictionaryItem[] $item
     */
    protected $item = null;

    public function __construct() {
        
    }

    /**
     * @return DictionaryItem[]
     */
    public function getItem() {
        return $this->item;
    }

    /**
     * @param DictionaryItem[] $item
     * @return \App\Service\ConnectShip\AMP\Dictionary
     */
    public function setItem(array $item = null) {
        $this->item = $item;
        return $this;
    }

}
