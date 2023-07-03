<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class SalesOrderCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\SalesOrder>")
     * @var SalesOrder[]
     */
    protected $salesOrders;
    private $position = 0;
    
    /**
     * @param SalesOrder[] $salesOrders
     */
    public function __construct(array $salesOrders) {
        $this->position = 0;
        $this->salesOrders = $salesOrders;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): SalesOrder {
        return $this->salesOrders[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->salesOrders[$this->position]);
    }



    /**
     * 
     * @return SalesOrder[]
     */
    function getSalesOrders() {
        return $this->salesOrders;
    }

    /**
     * 
     * @param SalesOrder[] $salesOrders
     * @return SalesOrderCollection
     */
    function setSalesOrders(array $salesOrders) {
        $this->salesOrders = $salesOrders;
        return $this;
    }

}
