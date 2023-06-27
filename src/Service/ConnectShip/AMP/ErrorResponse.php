<?php

namespace App\Service\ConnectShip\AMP;

class ErrorResponse {

    /**
     * @var Result $result
     */
    protected $result = null;

    /**
     * @param Result $result
     */
    public function __construct($result) {
        $this->result = $result;
    }

    /**
     * @return Result
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * @param Result $result
     * @return \App\Service\ConnectShip\AMP\ErrorResponse
     */
    public function setResult($result) {
        $this->result = $result;
        return $this;
    }

}
