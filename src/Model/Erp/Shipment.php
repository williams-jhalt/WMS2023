<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints\DateTime;

class Shipment extends SalesOrder {

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $manifestId;

    /**
     * @JMS\Type("DateTime")
     * @var DateTime
     */
    protected $shipDate;

    /**
     * @JMS\Type("integer")
     * @var int
     */
    protected $numberOfPages;

    /**
     * 
     * @return string
     */
    public function getManifestId() {
        return $this->manifestId;
    }

    /**
     * 
     * @return DateTime
     */
    public function getShipDate() {
        return $this->shipDate;
    }

    /**
     * 
     * @param string $manifestId
     * @return Shipment
     */
    public function setManifestId($manifestId) {
        $this->manifestId = $manifestId;
        return $this;
    }

    /**
     * 
     * @param DateTime $shipDate
     * @return Shipment
     */
    public function setShipDate($shipDate) {
        $this->shipDate = $shipDate;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getNumberOfPages() {
        return $this->numberOfPages;
    }

    /**
     * 
     * @param int $numberOfPages
     * @return Shipment
     */
    public function setNumberOfPages($numberOfPages) {
        $this->numberOfPages = $numberOfPages;
        return $this;
    }

}
