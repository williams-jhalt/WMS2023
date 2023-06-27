<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class ShipmentPackageCollection {

    /**
     * @JMS\Type("array<App\Model\Erp\ShipmentPackage>")
     * @var ShipmentPackage[]
     */
    protected $shipmentPackages;
    
    /**
     * @param ShipmentPackage[] $shipmentPackages
     */
    public function __construct(array $shipmentPackages) {
        $this->shipmentPackages = $shipmentPackages;
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
