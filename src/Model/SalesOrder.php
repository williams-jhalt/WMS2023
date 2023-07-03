<?php

namespace App\Model;

use DateTime;
use App\Model\Erp\ShipmentPackage;

class SalesOrder extends \App\Model\Erp\SalesOrder {

    const COMPANY_MUFFS = 'muffs';
    const COMPANY_WILLIAMS = 'williams';
    const SOURCE_WEBSITE = 'website';
    const SOURCE_CSR = 'csr';

    protected $websiteOrderDate;
    protected $websiteNotes;
    protected $shippingDate;
    protected $company;
    protected $source;
    
    /**
     * 
     * @param \App\Model\Erp\SalesOrder $salesOrder
     */
    public function __construct($salesOrder = null) {
        if ($salesOrder !== null) {
            $this->customerNumber = $salesOrder->customerNumber;
            $this->customerPurchaseOrder = $salesOrder->customerPurchaseOrder;
            $this->open = $salesOrder->open;
            $this->orderDate = $salesOrder->orderDate;
            $this->orderNumber = $salesOrder->orderNumber;
            $this->recordSequence = $salesOrder->recordSequence;
            $this->shipToAddress1 = $salesOrder->shipToAddress1;
            $this->shipToAddress2 = $salesOrder->shipToAddress2;
            $this->shipToAddress3 = $salesOrder->shipToAddress3;
            $this->shipToCity = $salesOrder->shipToCity;
            $this->shipToCountry = $salesOrder->shipToCountry;
            $this->shipToEmail = $salesOrder->shipToEmail;
            $this->shipToName = $salesOrder->shipToName;
            $this->shipToPhone = $salesOrder->shipToPhone;
            $this->shipToState = $salesOrder->shipToState;
            $this->shipToZip = $salesOrder->shipToZip;
            $this->shipViaCode = $salesOrder->shipViaCode;
            $this->sourceCode = $salesOrder->sourceCode;
            $this->status = $salesOrder->status;
            $this->webReferenceNumber = $salesOrder->webReferenceNumber;
        }
    }

    /**
     *
     * @var ShipmentPackage[]
     */
    protected $cartons;

    /**
     * 
     * @return DateTime
     */
    public function getShippingDate() {
        return $this->shippingDate;
    }

    /**
     * 
     * @param DateTime $shippingDate
     * @return SalesOrder
     */
    public function setShippingDate($shippingDate) {
        $this->shippingDate = $shippingDate;
        return $this;
    }

    /**
     * 
     * @return DateTime
     */
    public function getWebsiteOrderDate() {
        return $this->websiteOrderDate;
    }

    /**
     * 
     * @return string
     */
    public function getWebsiteNotes() {
        return $this->websiteNotes;
    }

    /**
     * 
     * @param DateTime $websiteOrderDate
     * @return SalesOrder
     */
    public function setWebsiteOrderDate($websiteOrderDate) {
        $this->websiteOrderDate = $websiteOrderDate;
        return $this;
    }

    /**
     * 
     * @param DateTime $websiteNotes
     * @return SalesOrder
     */
    public function setWebsiteNotes($websiteNotes) {
        $this->websiteNotes = $websiteNotes;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getWebsiteId() {
        return preg_replace("/WEB(\d+)/", "$1", $this->webReferenceNumber);
    }

    /**
     * 
     * @return string
     */
    public function getCompany() {

        if (strtolower(substr($this->customerNumber, -1)) == 'i') {
            return self::COMPANY_MUFFS;
        } else {
            return self::COMPANY_WILLIAMS;
        }
    }

    /**
     * 
     * @param string $company
     * @return SalesOrder
     */
    public function setCompany($company) {
        $this->company = $company;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getSource() {
        return $this->source;
    }

    /**
     * 
     * @param string $source
     * @return SalesOrder
     */
    public function setSource($source) {
        $this->source = $source;
        return $this;
    }

    /**
     * 
     * @return ShipmentPackage[]
     */
    public function getCartons() {
        return $this->cartons;
    }

    /**
     * 
     * @param ShipmentPackage[] $cartons
     * @return SalesOrder
     */
    public function setCartons(array $cartons) {
        $this->cartons = $cartons;
        return $this;
    }

    /**
     * Calculate total volume of all cartons (in cubic inches)
     * 
     * @return double
     */
    public function getTotalVolume() {

        $volume = 0.0;

        foreach ($this->cartons as $carton) {
            $volume += ((double) $carton->getPackageHeight() * (double) $carton->getPackageLength() * (double) $carton->getPackageWidth());
        }

        return (double) $volume;
    }

    /**
     * Calculate total weight of all cartons (in pounds)
     * 
     * @return double
     */
    public function getTotalWeight() {

        $weight = 0.0;

        foreach ($this->cartons as $carton) {

            $weight += $carton->getShippingWeight();
        }

        return (double) $weight;
    }
    
    /**
     * Calculate total cost for all shipments
     * 
     * @return double
     */
    public function getTotalFreightCost() {
        
        $freight = 0.0;
        
        foreach ($this->cartons as $carton) {
            $freight += $carton->getFreightCost();
        }
        
        return (double) $freight;
        
    }

}
