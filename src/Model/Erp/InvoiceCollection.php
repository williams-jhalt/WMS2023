<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class InvoiceCollection {

    /**
     * @JMS\Type("array<App\Model\Erp\Invoice>")
     * @var Invoice[]
     */
    protected $invoices;
    
    /**
     * @param Invoice[] $invoices
     */
    public function __construct(array $invoices) {
        $this->invoices = $invoices;
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
