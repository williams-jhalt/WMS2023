<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentItemCollection {

    /**
     * @JMS\Type("array<App\Model\Erp\ShipmentItem>")
     * @var ShipmentItem[]
     */
    protected $items;
    
    /**
     * @param ShipmentItem[] $items
     */
    public function __construct(array $items) {
        $this->items = $items;
    }

    /**
     * 
     * @return ShipmentItem[]
     */
    function getItems() {
        return $this->items;
    }

    /**
     * 
     * @param ShipmentItem[] $items
     * @return ShipmentItemCollection
     */
    function setItems(array $items) {
        $this->items = $items;
        return $this;
    }

}
