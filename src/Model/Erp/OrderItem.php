<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class OrderItem {

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $itemNumber;

    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $quantityOrdered;

    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $lineNumber;

    /**
     * 
     * @return string
     */
    public function getItemNumber() {
        return $this->itemNumber;
    }

    /**
     * 
     * @return integer
     */
    public function getQuantityOrdered() {
        return $this->quantityOrdered;
    }

    /**
     * 
     * @param string $itemNumber
     * @return OrderItem
     */
    public function setItemNumber($itemNumber) {
        $this->itemNumber = $itemNumber;
        return $this;
    }

    /**
     * 
     * @param integer $quantityOrdered
     * @return OrderItem
     */
    public function setQuantityOrdered($quantityOrdered) {
        $this->quantityOrdered = $quantityOrdered;
        return $this;
    }

    /**
     * 
     * @return integer
     */
    public function getLineNumber() {
        return $this->lineNumber;
    }

    /**
     * 
     * @param integer $lineNumber
     * @return OrderItem
     */
    public function setLineNumber($lineNumber) {
        $this->lineNumber = $lineNumber;
        return $this;
    }

}
