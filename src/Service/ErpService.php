<?php

namespace App\Service;

use ErpBundle\Repository\CustomerRepositoryInterface;
use ErpBundle\Repository\InvoiceRepositoryInterface;
use ErpBundle\Repository\PackerLogEntryRepositoryInterface;
use ErpBundle\Repository\ProductRepositoryInterface;
use ErpBundle\Repository\SalesOrderRepositoryInterface;
use ErpBundle\Repository\ShipmentRepositoryInterface;

interface ErpService {

    /**
     * @return ProductRepositoryInterface
     */
    public function getProductRepository();

    /**
     * @return SalesOrderRepositoryInterface
     */
    public function getSalesOrderRepository();

    /**
     * @return ShipmentRepositoryInterface
     */
    public function getShipmentRepository();

    /**
     * @return InvoiceRepositoryInterface
     */
    public function getInvoiceRepository();

    /**
     * @return CustomerRepositoryInterface
     */
    public function getCustomerRepository();

    /**
     * @return PackerLogEntryRepositoryInterface
     */
    public function getPackerLogEntryRepository();
    
}
