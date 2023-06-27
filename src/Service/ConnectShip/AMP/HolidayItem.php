<?php

namespace App\Service\ConnectShip\AMP;

class HolidayItem {

    /**
     * @var string $key
     */
    protected $key = null;

    /**
     * @var HolidayList $value
     */
    protected $value = null;

    /**
     * @param string $key
     * @param HolidayList $value
     */
    public function __construct($key, $value) {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @param string $key
     * @return \App\Service\ConnectShip\AMP\HolidayItem
     */
    public function setKey($key) {
        $this->key = $key;
        return $this;
    }

    /**
     * @return HolidayList
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param HolidayList $value
     * @return \App\Service\ConnectShip\AMP\HolidayItem
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

}
