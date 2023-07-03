<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class OrderItemCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\OrderItem>")
     * @var OrderItem[]
     */
    protected $items;
    private $position = 0;
    
    /**
     * @param OrderItem[] $items
     */
    public function __construct(array $items) {
        $this->position = 0;
        $this->items = $items;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): OrderItem {
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
     * @return OrderItem[]
     */
    function getItems() {
        return $this->items;
    }

    /**
     * 
     * @param OrderItem[] $items
     * @return OrderItemCollection
     */
    function setItems(array $items) {
        $this->items = $items;
        return $this;
    }

}
