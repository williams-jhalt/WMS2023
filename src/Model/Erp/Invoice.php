<?php

namespace App\Model\Erp;

use DateTime;
use JMS\Serializer\Annotation as JMS;

class Invoice extends SalesOrder {

    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $invoiceNumber;
    
    /**
     * @JMS\Type("DateTime")
     * @var DateTime
     */
    protected $invoiceDate;
    
    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $grossInvoiceAmount;
    
    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $netInvoiceAmount;
    
    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $shippingAndHandling;
    
    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $freightCharge;

    /**
     * 
     * @return integer
     */
    public function getInvoiceNumber() {
        return $this->invoiceNumber;
    }

    /**
     * 
     * @param integer $invoiceNumber
     * @return Invoice
     */
    public function setInvoiceNumber($invoiceNumber) {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    /**
     * 
     * @return integer
     */
    public function getInvoiceDate() {
        return $this->invoiceDate;
    }

    /**
     * 
     * @return double
     */
    public function getGrossInvoiceAmount() {
        return $this->grossInvoiceAmount;
    }

    /**
     * 
     * @return double
     */
    public function getNetInvoiceAmount() {
        return $this->netInvoiceAmount;
    }

    /**
     * 
     * @return double
     */
    public function getShippingAndHandling() {
        return $this->shippingAndHandling;
    }

    /**
     * 
     * @return double
     */
    public function getFreightCharge() {
        return $this->freightCharge;
    }

    /**
     * 
     * @param DateTime $invoiceDate
     * @return Invoice
     */
    public function setInvoiceDate($invoiceDate) {
        $this->invoiceDate = $invoiceDate;
        return $this;
    }

    /**
     * 
     * @param double $grossInvoiceAmount
     * @return Invoice
     */
    public function setGrossInvoiceAmount($grossInvoiceAmount) {
        $this->grossInvoiceAmount = $grossInvoiceAmount;
        return $this;
    }

    /**
     * 
     * @param double $netInvoiceAmount
     * @return Invoice
     */
    public function setNetInvoiceAmount($netInvoiceAmount) {
        $this->netInvoiceAmount = $netInvoiceAmount;
        return $this;
    }

    /**
     * 
     * @param double $shippingAndHandling
     * @return Invoice
     */
    public function setShippingAndHandling($shippingAndHandling) {
        $this->shippingAndHandling = $shippingAndHandling;
        return $this;
    }

    /**
     * 
     * @param double $freightCharge
     * @return Invoice
     */
    public function setFreightCharge($freightCharge) {
        $this->freightCharge = $freightCharge;
        return $this;
    }

}
