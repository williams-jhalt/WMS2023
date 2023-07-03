<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentPackageItemCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\ShipmentPackageItem>")
     * @var ShipmentPackageItem[]
     */
    protected $items;
    private $position = 0;
    
    /**
     * @param ShipmentPackageItem[] $shipmentPackages
     */
    public function __construct(array $items) {
        $this->position = 0;
        $this->items = $items;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): ShipmentPackageItem {
        return $this->items[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->items[$this->position]);
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
