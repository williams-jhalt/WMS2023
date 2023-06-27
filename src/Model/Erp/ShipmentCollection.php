<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentCollection {

    /**
     * @JMS\Type("array<App\Model\Erp\Shipment>")
     * @var Shipment[]
     */
    protected $shipments;
    
    /**
     * @param Shipment[] $shipments
     */
    public function __construct(array $shipments) {
        $this->shipments = $shipments;
    }

    /**
     * 
     * @return Shipment[]
     */
    function getShipments() {
        return $this->shipments;
    }

    /**
     * 
     * @param Shipment[] $shipments
     * @return ShipmentCollection
     */
    function setShipments(array $shipments) {
        $this->shipments = $shipments;
        return $this;
    }

}
