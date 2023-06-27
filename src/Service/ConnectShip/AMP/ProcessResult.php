<?php

namespace App\Service\ConnectShip\AMP;

class ProcessResult {

    /**
     * @var int $code
     */
    protected $code = null;

    /**
     * @var string $message
     */
    protected $message = null;

    /**
     * @var DataDictionary $resultData
     */
    protected $resultData = null;

    /**
     * @var PackageResultList $packageResults
     */
    protected $packageResults = null;

    /**
     * @var Identity $service
     */
    protected $service = null;

    /**
     * @param int $code
     * @param string $message
     * @param DataDictionary $resultData
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
     * @return \App\Service\ConnectShip\AMP\ProcessResult
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
     * @return \App\Service\ConnectShip\AMP\ProcessResult
     */
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    /**
     * @return DataDictionary
     */
    public function getResultData() {
        return $this->resultData;
    }

    /**
     * @param DataDictionary $resultData
     * @return \App\Service\ConnectShip\AMP\ProcessResult
     */
    public function setResultData($resultData) {
        $this->resultData = $resultData;
        return $this;
    }

    /**
     * @return PackageResultList
     */
    public function getPackageResults() {
        return $this->packageResults;
    }

    /**
     * @param PackageResultList $packageResults
     * @return \App\Service\ConnectShip\AMP\ProcessResult
     */
    public function setPackageResults($packageResults) {
        $this->packageResults = $packageResults;
        return $this;
    }

    /**
     * @return Identity
     */
    public function getService() {
        return $this->service;
    }

    /**
     * @param Identity $service
     * @return \App\Service\ConnectShip\AMP\ProcessResult
     */
    public function setService($service) {
        $this->service = $service;
        return $this;
    }

}
