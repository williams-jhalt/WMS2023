<?php

namespace App\Model;

use App\Entity\Product;
use App\Service\ProductService;
use App\Model\Erp\SalesOrderItem;

class CreditEstimate {

    /**
     *
     * @var SalesOrder
     */
    private $salesOrder;

    /**
     *
     * @var SalesOrderItem[]
     */
    private $salesOrderItems;

    /**
     *
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService, $salesOrder, $salesOrderItems) {
        $this->productService = $productService;
        $this->salesOrder = $salesOrder;
        $this->salesOrderItems = $salesOrderItems;
    }

    public function getSalesOrder(): SalesOrder {
        return $this->salesOrder;
    }

    public function getSalesOrderItems(): array {
        return $this->salesOrderItems;
    }

    public function getProductService(): ProductService {
        return $this->productService;
    }

    public function setSalesOrder(SalesOrder $salesOrder) {
        $this->salesOrder = $salesOrder;
        return $this;
    }

    public function setSalesOrderItems(array $salesOrderItems) {
        $this->salesOrderItems = $salesOrderItems;
        return $this;
    }

    public function setProductService(ProductService $productService) {
        $this->productService = $productService;
        return $this;
    }
    
    public function getItemWeight(SalesOrderItem $item) {
        return (double) ($this->productService->getByItemNumber($item->getItemNumber())->getDetail()->getPackageWeight() * $item->getQuantityOrdered());
    }
    
    public function getTotalWeight() {
        $weight = 0.0;
        foreach ($this->salesOrderItems as $item) {            
            $weight += $this->getItemWeight($item);
        }
        return $weight;
    }

}
