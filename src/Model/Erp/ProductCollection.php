<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ProductCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\Product>")
     * @var Product[]
     */
    protected $products;
    private $position = 0;
    
    /**
     * @param Product[] $products
     */
    public function __construct(array $products) {
        $this->position = 0;
        $this->products = $products;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): Product {
        return $this->products[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->products[$this->position]);
    }


    /**
     * 
     * @return Product[]
     */
    function getProducts() {
        return $this->products;
    }

    /**
     * 
     * @param Product[] $products
     * @return ProductCollection
     */
    function setProducts(array $products) {
        $this->products = $products;
        return $this;
    }

}
