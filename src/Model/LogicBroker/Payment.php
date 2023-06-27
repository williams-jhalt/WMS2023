<?php

namespace App\Model\LogicBroker;

class Payment {

    /**
     *
     * @JMS\SerializedName("Method")
     * @var string
     */
    private $method;

    public function getMethod() {
        return $this->method;
    }

    public function setMethod($method) {
        $this->method = $method;
        return $this;
    }

}
