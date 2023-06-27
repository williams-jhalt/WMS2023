<?php

namespace App\Service\ConnectShip\AMP;

class Money {

    /**
     * @var float $amount
     */
    protected $amount = null;

    /**
     * @var currency $currency
     */
    protected $currency = null;

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
     * @return \App\Service\ConnectShip\AMP\Money
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return currency
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param currency $currency
     * @return \App\Service\ConnectShip\AMP\Money
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
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
     * @return \App\Service\ConnectShip\AMP\Money
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

}
