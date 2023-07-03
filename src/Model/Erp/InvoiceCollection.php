<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class InvoiceCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\Invoice>")
     * @var Invoice[]
     */
    protected $invoices;
    private $position = 0;
    
    /**
     * @param Invoice[] $invoices
     */
    public function __construct(array $invoices) {
        $this->position = 0;
        $this->invoices = $invoices;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): Invoice {
        return $this->invoices[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->invoices[$this->position]);
    }
    
    /**
     * 
     * @return Invoice[]
     */
    function getInvoices() {
        return $this->invoices;
    }

    /**
     * 
     * @param Invoice[] $invoices
     */
    function setInvoices($invoices) {
        $this->invoices = $invoices;
    }

}
