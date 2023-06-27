<?php

namespace App\Service\ConnectShip\AMP;

class HazmatQuantity {

    /**
     * @var float $amount
     */
    protected $amount = null;

    /**
     * @var string $unit
     */
    protected $unit = null;

    /**
     * @var string $value
     */
    protected $value = null;

    public function __construct() {
        
    }

    /**
     * @return float
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return \App\Service\ConnectShip\AMP\HazmatQuantity
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit() {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return \App\Service\ConnectShip\AMP\HazmatQuantity
     */
    public function setUnit($unit) {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param string $value
     * @return \App\Service\ConnectShip\AMP\HazmatQuantity
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

}
