<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class InvoiceItemCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\InvoiceItem>")
     * @var InvoiceItem[]
     */
    protected $items;
    private $position = 0;
    
    /**
     * @param InvoiceItem[] $items
     */
    public function __construct(array $items) {
        $this->position = 0;
        $this->items = $items;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): InvoiceItem {
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
     * @return InvoiceItem[]
     */
    function getItems() {
        return $this->items;
    }

    /**
     * 
     * @param InvoiceItem[] $items
     * 
     * @return InvoiceItem[]
     */
    function setItems(array $items) {
        $this->items = $items;
        return $this;
    }

}
