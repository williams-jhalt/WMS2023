<?php

namespace App\Service\ConnectShip\AMP;

class VoidPackageResult {

    /**
     * @var int $code
     */
    protected $code = null;

    /**
     * @var string $message
     */
    protected $message = null;

    /**
     * @var int $package
     */
    protected $package = null;

    /**
     * @param int $code
     * @param string $message
     * @param int $package
     */
    public function __construct($code, $message, $package) {
        $this->code = $code;
        $this->message = $message;
        $this->package = $package;
    }

    /**
     * @return int
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * @param int $code
     * @return \App\Service\ConnectShip\AMP\VoidPackageResult
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
     * @return \App\Service\ConnectShip\AMP\VoidPackageResult
     */
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    /**
     * @return int
     */
    public function getPackage() {
        return $this->package;
    }

    /**
     * @param int $package
     * @return \App\Service\ConnectShip\AMP\VoidPackageResult
     */
    public function setPackage($package) {
        $this->package = $package;
        return $this;
    }

}
