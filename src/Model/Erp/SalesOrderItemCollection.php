<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class SalesOrderItemCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\SalesOrderItem>")
     * @var SalesOrderItem[]
     */
    protected $items;
    private $position = 0;
    
    /**
     * @param SalesOrderItem[] $items
     */
    public function __construct(array $items) {
        $this->position = 0;
        $this->items = $items;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): SalesOrderItem {
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
     * @return SalesOrderItem[]
     */
    function getItems() {
        return $this->items;
    }

    /**
     * 
     * @param SalesOrderItem[] $items
     * @return SalesOrderItemCollection
     */
    function setItems(array $items) {
        $this->items = $items;
    }

}
