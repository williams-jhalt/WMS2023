<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentPackageItem {

    
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $itemNumber;
    
    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $quantity;

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
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * 
     * @param string $itemNumber
     * @return ShipmentPackageItem
     */
    public function setItemNumber($itemNumber) {
        $this->itemNumber = $itemNumber;
        return $this;
    }

    /**
     * 
     * @param integer $quantity
     * @return ShipmentPackageItem
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

}
