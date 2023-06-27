<?php

namespace App\Service\ConnectShip\AMP;

class ListGroupsResult {

    /**
     * @var int $code
     */
    protected $code = null;

    /**
     * @var string $message
     */
    protected $message = null;

    /**
     * @var GroupList $resultData
     */
    protected $resultData = null;

    /**
     * @param int $code
     * @param string $message
     * @param GroupList $resultData
     */
    public function __construct($code, $message, $resultData) {
        $this->code = $code;
        $this->message = $message;
        $this->resultData = $resultData;
    }

    /**
     * @return int
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * @param int $code
     * @return \App\Service\ConnectShip\AMP\ListGroupsResult
     */
    public function setCode($code) {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @param string $message
     * @return \App\Service\ConnectShip\AMP\ListGroupsResult
     */
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    /**
     * @return GroupList
     */
    public function getResultData() {
        return $this->resultData;
    }

    /**
     * @param GroupList $resultData
     * @return \App\Service\ConnectShip\AMP\ListGroupsResult
     */
    public function setResultData($resultData) {
        $this->resultData = $resultData;
        return $this;
    }

}
