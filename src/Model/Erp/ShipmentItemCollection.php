<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentItemCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\ShipmentItem>")
     * @var ShipmentItem[]
     */
    protected $items;
    private $position = 0;
    
    /**
     * @param ShipmentItem[] $items
     */
    public function __construct(array $items) {
        $this->position = 0;
        $this->items = $items;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): ShipmentItem {
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
