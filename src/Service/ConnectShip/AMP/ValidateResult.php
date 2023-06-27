<?php

namespace App\Service\ConnectShip\AMP;

class ValidateResult {

    /**
     * @var int $code
     */
    protected $code = null;

    /**
     * @var string $message
     */
    protected $message = null;

    /**
     * @var CandidateAddressList $resultData
     */
    protected $resultData = null;

    /**
     * @var int $resultType
     */
    protected $resultType = null;

    /**
     * @param int $code
     * @param string $message
     * @param CandidateAddressList $resultData
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
     * @return \App\Service\ConnectShip\AMP\ValidateResult
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
     * @return \App\Service\ConnectShip\AMP\ValidateResult
     */
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    /**
     * @return CandidateAddressList
     */
    public function getResultData() {
        return $this->resultData;
    }

    /**
     * @param CandidateAddressList $resultData
     * @return \App\Service\ConnectShip\AMP\ValidateResult
     */
    public function setResultData($resultData) {
        $this->resultData = $resultData;
        return $this;
    }

    /**
     * @return int
     */
    public function getResultType() {
        return $this->resultType;
    }

    /**
     * @param int $resultType
     * @return \App\Service\ConnectShip\AMP\ValidateResult
     */
    public function setResultType($resultType) {
        $this->resultType = $resultType;
        return $this;
    }

}
