<?php

namespace App\Service\ConnectShip\AMP;

class AddHolidayResponse {

    /**
     * @var StringResult $result
     */
    protected $result = null;

    /**
     * @var string $asyncCorrelationData
     */
    protected $asyncCorrelationData = null;

    /**
     * @param StringResult $result
     * @param string $asyncCorrelationData
     */
    public function __construct($result, $asyncCorrelationData) {
        $this->result = $result;
        $this->asyncCorrelationData = $asyncCorrelationData;
    }

    /**
     * @return StringResult
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * @param StringResult $result
     * @return \App\Service\ConnectShip\AMP\AddHolidayResponse
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
     * @return \App\Service\ConnectShip\AMP\AddHolidayResponse
     */
    public function setAsyncCorrelationData($asyncCorrelationData) {
        $this->asyncCorrelationData = $asyncCorrelationData;
        return $this;
    }

}
