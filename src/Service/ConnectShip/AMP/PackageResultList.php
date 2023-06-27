<?php

namespace App\Service\ConnectShip\AMP;

class PackageResultList {

    /**
     * @var PackageResult[] $item
     */
    protected $item = null;

    public function __construct() {
        
    }

    /**
     * @return PackageResult[]
     */
    public function getItem() {
        return $this->item;
    }

    /**
     * @param PackageResult[] $item
     * @return \App\Service\ConnectShip\AMP\PackageResultList
     */
    public function setItem(array $item = null) {
        $this->item = $item;
        return $this;
    }

}
