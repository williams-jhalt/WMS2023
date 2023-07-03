<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class CustomerCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\Customer>")
     * @var Customer[]
     */
    protected $customers;
    private $position = 0;
    
    /**
     * @param Customer[] $customers
     */
    public function __construct(array $customers) {
        $this->position = 0;
        $this->customers = $customers;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): Customer {
        return $this->customers[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->customers[$this->position]);
    }

    /**
     * 
     * @return Customer[]
     */
    function getCustomers() {
        return $this->customers;
    }

    /**
     * 
     * @param Customer[] $customers
     */
    function setCustomers($customers) {
        $this->customers = $customers;
    }

}
