<?php

namespace App\Service\ConnectShip\AMP;

class SearchPackageResultList {

    /**
     * @var SearchPackageResult[] $item
     */
    protected $item = null;

    public function __construct() {
        
    }

    /**
     * @return SearchPackageResult[]
     */
    public function getItem() {
        return $this->item;
    }

    /**
     * @param SearchPackageResult[] $item
     * @return \App\Service\ConnectShip\AMP\SearchPackageResultList
     */
    public function setItem(array $item = null) {
        $this->item = $item;
        return $this;
    }

}
