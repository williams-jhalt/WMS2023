<?php

namespace App\Service\ConnectShip\AMP;

class CandidateAddress {

    /**
     * @var NameAddress $address
     */
    protected $address = null;

    /**
     * @var boolean $residentialCommercialProvided
     */
    protected $residentialCommercialProvided = null;

    /**
     * @param NameAddress $address
     * @param boolean $residentialCommercialProvided
     */
    public function __construct($address, $residentialCommercialProvided) {
        $this->address = $address;
        $this->residentialCommercialProvided = $residentialCommercialProvided;
    }

    /**
     * @return NameAddress
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @param NameAddress $address
     * @return \App\Service\ConnectShip\AMP\CandidateAddress
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getResidentialCommercialProvided() {
        return $this->residentialCommercialProvided;
    }

    /**
     * @param boolean $residentialCommercialProvided
     * @return \App\Service\ConnectShip\AMP\CandidateAddress
     */
    public function setResidentialCommercialProvided($residentialCommercialProvided) {
        $this->residentialCommercialProvided = $residentialCommercialProvided;
        return $this;
    }

}
