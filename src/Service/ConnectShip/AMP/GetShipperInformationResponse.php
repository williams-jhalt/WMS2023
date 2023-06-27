<?php

namespace App\Service\ConnectShip\AMP;

class GetShipperInformationResponse {

    /**
     * @var ShipperResult $result
     */
    protected $result = null;

    /**
     * @var string $asyncCorrelationData
     */
    protected $asyncCorrelationData = null;

    /**
     * @param ShipperResult $result
     * @param string $asyncCorrelationData
     */
    public function __construct($result, $asyncCorrelationData) {
        $this->result = $result;
        $this->asyncCorrelationData = $asyncCorrelationData;
    }

    /**
     * @return ShipperResult
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * @param ShipperResult $result
     * @return \App\Service\ConnectShip\AMP\GetShipperInformationResponse
     */
    public function setResult($result) {
        $this->result = $result;
        return $this;
    }

    /**
     * @return string
     */
    public function getAsyncCorrelationData() {
        return $this->asyncCorrelationData;
    }

    /**
     * @param string $asyncCorrelationData
     * @return \App\Service\ConnectShip\AMP\GetShipperInformationResponse
     */
    public function setAsyncCorrelationData($asyncCorrelationData) {
        $this->asyncCorrelationData = $asyncCorrelationData;
        return $this;
    }

}
