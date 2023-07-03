<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class OrderCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\Order>")
     * @var Order[]
     */
    protected $orders;
    private $position = 0;
    
    /**
     * @param Order[] $items
     */
    public function __construct(array $items) {
        $this->position = 0;
        $this->orders = $items;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): Order {
        return $this->orders[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->orders[$this->position]);
    }

    /**
     * 
     * @return Order[]
     */
    function getOrders() {
        return $this->orders;
    }

    /**
     * 
     * @param Order[] $orders
     * @return OrderCollection
     */
    function setOrders(array $orders) {
        $this->orders = $orders;
        return $this;
    }

}
