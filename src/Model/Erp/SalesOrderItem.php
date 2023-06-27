<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class SalesOrderItem {

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
     * @JMS\Type("string")
     * @var string
     */
    protected $unitOfMeasure;

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
     * @return self
     */
    public function setItemNumber($itemNumber) {
        $this->itemNumber = $itemNumber;
        return $this;
    }

    /**
     * 
     * @param integer $quantityOrdered
     * @return self
     */
    public function setQuantityOrdered($quantityOrdered) {
        $this->quantityOrdered = $quantityOrdered;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getUnitOfMeasure() {
        return $this->unitOfMeasure;
    }

    /**
     * 
     * @param string $unitOfMeasure
     * @return self
     */
    public function setUnitOfMeasure($unitOfMeasure) {
        $this->unitOfMeasure = $unitOfMeasure;
        return $this;
    }

    /**
     * 
     * @return self
     */
    public function getLineNumber() {
        return $this->lineNumber;
    }

    /**
     * 
     * @param integer $lineNumber
     * @return self
     */
    public function setLineNumber($lineNumber) {
        $this->lineNumber = $lineNumber;
        return $this;
    }

}
