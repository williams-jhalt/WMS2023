<?php

namespace App\Service\ConnectShip\AMP;

class RateResponse {

    /**
     * @var RateResult $result
     */
    protected $result = null;

    /**
     * @var string $asyncCorrelationData
     */
    protected $asyncCorrelationData = null;

    /**
     * @param RateResult $result
     * @param string $asyncCorrelationData
     */
    public function __construct($result, $asyncCorrelationData) {
        $this->result = $result;
        $this->asyncCorrelationData = $asyncCorrelationData;
    }

    /**
     * @return RateResult
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * @param RateResult $result
     * @return \App\Service\ConnectShip\AMP\RateResponse
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
     * @return \App\Service\ConnectShip\AMP\RateResponse
     */
    public function setAsyncCorrelationData($asyncCorrelationData) {
        $this->asyncCorrelationData = $asyncCorrelationData;
        return $this;
    }

}
