<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentItem extends SalesOrderItem {

    
    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $quantityShipped;

    /**
     * 
     * @return integer
     */
    public function getQuantityShipped() {
        return $this->quantityShipped;
    }

    /**
     * 
     * @param integer $quantityShipped
     * @return ShipmentItem
     */
    public function setQuantityShipped($quantityShipped) {
        $this->quantityShipped = $quantityShipped;
        return $this;
    }

}
