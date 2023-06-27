<?php

namespace App\Model\Wholesale;

class ProductTypeCollection {

    private $offset;
    private $limit;
    private $total;
    private $items;

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
