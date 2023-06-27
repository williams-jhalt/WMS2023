<?php

namespace App\Service;

use JMS\Serializer\Serializer;
use ErpBundle\Repository\ClientCustomerRepository;
use ErpBundle\Repository\ClientInvoiceRepository;
use ErpBundle\Repository\ClientProductRepository;
use ErpBundle\Repository\ClientSalesOrderRepository;
use ErpBundle\Repository\ClientShipmentRepository;

class ErpClientService implements ErpService {

    private $host;
    private $username;
    private $password;
    private $serializer;

    public function __construct($host, $username, $password, Serializer $serializer) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->serializer = $serializer;
    }

    /**
     * 
     * @return ClientProductRepository
     */
    public function getProductRepository() {
        return new ClientProductRepository($this);
    }

    /**
     * 
     * @return ClientSalesOrderRepository
     */
    public function getSalesOrderRepository() {
        return new ClientSalesOrderRepository($this);
    }

    /**
     * 
     * @return ClientShipmentRepository
     */
    public function getShipmentRepository() {
        return new ClientShipmentRepository($this);
    }

    /**
     * 
     * @return ClientInvoiceRepository
     */
    public function getInvoiceRepository() {
        return new ClientInvoiceRepository($this);
    }

    /**
     * 
     * @return ClientCustomerRepository
     */
    public function getCustomerRepository() {
        return new ClientCustomerRepository($this);
    }

    /**
     * Gets the host / url for queries
     * 
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * Get the username for the http request
     * 
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Get the password for the http request
     * 
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Gets the serializer
     * 
     * @return Serializer
     */
    public function getSerializer() {
        return $this->serializer;
    }
    
    public function getPackerLogEntryRepository(): \ErpBundle\Repository\PackerLogEntryRepositoryInterface {
        throw new Exception("Not Yet Implemented");
    }


}
