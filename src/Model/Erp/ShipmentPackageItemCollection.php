<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentPackageItemCollection {

    /**
     * @JMS\Type("array<App\Model\Erp\ShipmentPackageItem>")
     * @var ShipmentPackageItem[]
     */
    protected $items;
    
    /**
     * @param ShipmentPackageItem[] $items
     */
    public function __construct(array $items) {
        $this->items = $items;
    }

    /**
     * 
     * @return ShipmentPackageItem[]
     */
    function getItems() {
        return $this->items;
    }

    /**
     * 
     * @param ShipmentPackageItem[] $items
     * @return ShipmentPackageItemCollection
     */
    function setItems(array $items) {
        $this->items = $items;
        return $this;
    }

}
