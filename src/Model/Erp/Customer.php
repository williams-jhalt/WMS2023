<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class Customer {

    /**
     * @JMS\Type("string")
     * @var string
     */
    private $customerNumber;

    /**
     * @JMS\Type("string")
     * @var string
     */
    private $name;

    public function getCustomerNumber() {
        return $this->customerNumber;
    }

    public function getName() {
        return $this->name;
    }

    public function setCustomerNumber($customerNumber) {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

}
