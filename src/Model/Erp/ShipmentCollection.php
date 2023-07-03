<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\Shipment>")
     * @var Shipment[]
     */
    protected $shipments;
    private $position = 0;
    
    /**
     * @param Shipment[] $shipments
     */
    public function __construct(array $shipments) {
        $this->position = 0;
        $this->shipments = $shipments;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): Shipment {
        return $this->shipments[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->shipments[$this->position]);
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
