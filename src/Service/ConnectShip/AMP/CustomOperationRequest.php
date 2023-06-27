<?php

namespace App\Service\ConnectShip\AMP;

class CustomOperationRequest {

    /**
     * @var string $processName
     */
    protected $processName = null;

    /**
     * @var anyType $processData
     */
    protected $processData = null;

    /**
     * @var string $preProcess
     */
    protected $preProcess = null;

    /**
     * @var string $postProcess
     */
    protected $postProcess = null;

    /**
     * @var language $locale
     */
    protected $locale = null;

    /**
     * @var string $asyncCorrelationData
     */
    protected $asyncCorrelationData = null;

    /**
     * @param string $processName
     * @param anyType $processData
     * @param string $preProcess
     * @param string $postProcess
     * @param language $locale
     * @param string $asyncCorrelationData
     */
    public function __construct($processName, $processData, $preProcess, $postProcess, $locale, $asyncCorrelationData) {
        $this->processName = $processName;
        $this->processData = $processData;
        $this->preProcess = $preProcess;
        $this->postProcess = $postProcess;
        $this->locale = $locale;
        $this->asyncCorrelationData = $asyncCorrelationData;
    }

    /**
     * @return string
     */
    public function getProcessName() {
        return $this->processName;
    }

    /**
     * @param string $processName
     * @return \App\Service\ConnectShip\AMP\CustomOperationRequest
     */
    public function setProcessName($processName) {
        $this->processName = $processName;
        return $this;
    }

    /**
     * @return anyType
     */
    public function getProcessData() {
        return $this->processData;
    }

    /**
     * @param anyType $processData
     * @return \App\Service\ConnectShip\AMP\CustomOperationRequest
     */
    public function setProcessData($processData) {
        $this->processData = $processData;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreProcess() {
        return $this->preProcess;
    }

    /**
     * @param string $preProcess
     * @return \App\Service\ConnectShip\AMP\CustomOperationRequest
     */
    public function setPreProcess($preProcess) {
        $this->preProcess = $preProcess;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostProcess() {
        return $this->postProcess;
    }

    /**
     * @param string $postProcess
     * @return \App\Service\ConnectShip\AMP\CustomOperationRequest
     */
    public function setPostProcess($postProcess) {
        $this->postProcess = $postProcess;
        return $this;
    }

    /**
     * @return language
     */
    public function getLocale() {
        return $this->locale;
    }

    /**
     * @param language $locale
     * @return \App\Service\ConnectShip\AMP\CustomOperationRequest
     */
    public function setLocale($locale) {
        $this->locale = $locale;
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
     * @return \App\Service\ConnectShip\AMP\CustomOperationRequest
     */
    public function setAsyncCorrelationData($asyncCorrelationData) {
        $this->asyncCorrelationData = $asyncCorrelationData;
        return $this;
    }

}
