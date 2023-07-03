<?php

namespace App\Model\Wholesale;

class ProductTypeCollection implements \Iterator {

    private $offset;
    private $limit;
    private $total;
    private $items;
    private $position = 0;

    public function __construct() {
        $this->position = 0;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): ProductType {
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

    public function getOffset() {
        return $this->offset;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getItems() {
        return $this->items;
    }

    public function setOffset($offset) {
        $this->offset = $offset;
        return $this;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }

    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }

    public function setItems($items) {
        $this->items = $items;
        return $this;
    }

}
