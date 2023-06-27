<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ProductCollection {

    /**
     * @JMS\Type("array<App\Model\Erp\Product>")
     * @var Product[]
     */
    protected $products;
    
    /**
     * @param Product[] $products
     */
    public function __construct(array $products) {
        $this->products = $products;
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
