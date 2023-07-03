<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentPackageCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\ShipmentPackage>")
     * @var ShipmentPackage[]
     */
    protected $shipmentPackages;
    private $position = 0;
    
    /**
     * @param ShipmentPackage[] $shipmentPackages
     */
    public function __construct(array $shipmentPackages) {
        $this->position = 0;
        $this->shipmentPackages = $shipmentPackages;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): ShipmentPackage {
        return $this->shipmentPackages[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->shipmentPackages[$this->position]);
    }


    /**
     * 
     * @return ShipmentPackage[]
     */
    function getShipmentPackages() {
        return $this->shipmentPackages;
    }

    /**
     * 
     * @param ShipmentPackage[] $shipmentPackages
     * @return ShipmentPackageCollection
     */
    function setShipmentPackages(array $shipmentPackages) {
        $this->shipmentPackages = $shipmentPackages;
        return $this;
    }

}
