<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class InvoiceItem extends SalesOrderItem {

    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $quantityBilled;

    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $price;

    /**
     * 
     * @return integer
     */
    public function getQuantityBilled() {
        return $this->quantityBilled;
    }

    /**
     * 
     * @param integer $quantityBilled
     * @return InvoiceItem
     */
    public function setQuantityBilled($quantityBilled) {
        $this->quantityBilled = $quantityBilled;
        return $this;
    }

    /**
     * 
     * @return double
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * 
     * @param double $price
     * @return InvoiceItem
     */
    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

}
