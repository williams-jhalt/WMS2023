<?php

namespace App\Service;

use App\Model\SalesOrder;
use DateTime;
use App\Model\Erp\SalesOrder as SalesOrder2;
use App\Model\Erp\SalesOrderItem as SalesOrderItem;
use App\Model\Erp\SalesOrderItemCollection;
use App\Model\Erp\Shipment;
use App\Model\Erp\ShipmentItem;
use App\Model\Erp\ShipmentPackage;
use App\Service\ErpService as ErpService;
use App\Model\Wms\Weborder;
use App\Repository\CartonRepository;

class OrderService {

    const WMS_MUFFS = 'muffs';
    const WMS_WILLIAMS = 'williams';

    /**
     * @var ErpService
     */
    private $erp;

    /**
     * @var WmsService
     */
    private $muffsWms;

    /**
     * @var WmsService
     */
    private $williamsWms;

    /**
     * @var CartonRepository
     */
    private $cartonRepo;

    public function __construct(ErpService $erp, MuffsWmsService $muffsWms, WilliamsWmsService $williamsWms, CartonRepository $cartonRepo) {
        $this->erp = $erp;
        $this->muffsWms = $muffsWms;
        $this->williamsWms = $williamsWms;
        $this->cartonRepo = $cartonRepo;
    }

    /**
     * 
     * @return Weborder[]
     */
    public function getNewOrders($company = self::WMS_WILLIAMS) {

        if ($company == self::WMS_MUFFS) {
            $repo = $this->muffsWms->getWeborderRepository();
        } else {
            $repo = $this->williamsWms->getWeborderRepository();
        }

        return $repo->getNewOrders();
    }

    /**
     * @return SalesOrder
     */
    public function getOrder($orderNumber) {

        $erpOrder = $this->erp->getSalesOrderRepository()->get($orderNumber);

        $order = new SalesOrder();

        $this->loadOrderFromErp($order, $erpOrder);

        try {

            if (strtoupper(substr($order->getCustomerNumber(), -1)) == 'I') {
                $weborder = $this->muffsWms->getWeborderRepository()->getOrder($order->getWebsiteId());
            } else {
                $weborder = $this->williamsWms->getWeborderRepository()->getOrder($order->getWebsiteId());
            }

            if ($weborder !== null) {
                $this->loadOrderFromWms($order, $weborder);
            }
            
        } catch (\Exception $e) {
            
        }

        return $order;
    }
    
    /**
     * @return SalesOrderItem[]
     */
    public function getOrderItems($orderNumber) {
        $erpOrderItems = $this->erp->getSalesOrderRepository()->getItems($orderNumber);
        return $erpOrderItems->getItems();        
    }

    /**
     * @return ShipmentPackage[]
     */
    public function getCartons($orderNumber) {

        $repo = $this->cartonRepo;
        $cartons = $this->erp->getShipmentRepository()->getPackages($orderNumber)->getShipmentPackages();

        foreach ($cartons as $carton) {

            $c = $repo->find($carton->getUcc());

            if ($c !== null) {
                $carton->setPackageHeight($c->getHeight());
                $carton->setPackageLength($c->getLength());
                $carton->setPackageWidth($c->getWidth());
                $carton->setShippingWeight($c->getWeight());
            }
        }

        return $cartons;
    }

    /**
     * Get orders from website by date, company can be one of:
     * 
     * OrderService::WMS_WILLIAMS
     * OrderService::WMS_MUFFS
     * 
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param string $company
     * 
     * @return Weborder[]
     */
    public function getWebsiteOrdersByDate(DateTime $startDate, DateTime $endDate, $company) {

        if ($company == self::WMS_WILLIAMS) {
            return $this->williamsWms->getWeborderRepository()->findByOrderDate($startDate, $endDate);
        } else {
            return $this->muffsWms->getWeborderRepository()->findByOrderDate($startDate, $endDate);
        }
    }

    public function getOrdersByDate(DateTime $startDate, DateTime $endDate, $company = self::WMS_WILLIAMS) {

        if ($company == self::WMS_MUFFS) {
            return $this->getMuffsOrdersByDate($startDate, $endDate);
        } else {
            return $this->getWilliamsOrdersByDate($startDate, $endDate);
        }
    }

    private function getWilliamsOrdersByDate(DateTime $startDate, DateTime $endDate) {

        $result = array();

        $limit = 1000;
        $offset = 0;

        do {

            $erpOrders = $this->erp->getSalesOrderRepository()->findByOrderDate($startDate, $endDate, $limit, $offset)->getSalesOrders();

            foreach ($erpOrders as $erpOrder) {

                if (strtoupper(substr($erpOrder->getCustomerNumber(), -1)) == 'I') {
                    continue;
                }

                $salesOrder = new SalesOrder();

                $salesOrder->setCompany(SalesOrder::COMPANY_WILLIAMS);

                $this->loadOrderFromErp($salesOrder, $erpOrder);

                if (!empty($erpOrder->getWebReferenceNumber())) {
                    $salesOrder->setSource(SalesOrder::SOURCE_WEBSITE);
                    $weborder = $this->williamsWms->getWeborderRepository()->getOrder($salesOrder->getWebsiteId());
                    $this->loadOrderFromWms($salesOrder, $weborder);
                } else {
                    $salesOrder->setSource(SalesOrder::SOURCE_CSR);
                }

                $result[] = $salesOrder;
            }

            $offset += $limit;
        } while (count($erpOrders) > 0);

        return $result;
    }

    private function getMuffsOrdersByDate(DateTime $startDate, DateTime $endDate) {

        $result = array();

        $limit = 1000;
        $offset = 0;

        do {

            $erpOrders = $this->erp->getSalesOrderRepository()->findByOrderDate($startDate, $endDate, $limit, $offset)->getSalesOrders();

            foreach ($erpOrders as $erpOrder) {

                if (strtoupper(substr($erpOrder->getCustomerNumber(), -1)) != 'I') {
                    continue;
                }

                $salesOrder = new SalesOrder();

                $salesOrder->setCompany(SalesOrder::COMPANY_MUFFS);

                $this->loadOrderFromErp($salesOrder, $erpOrder);

                if (!empty($erpOrder->getWebReferenceNumber())) {
                    $salesOrder->setSource(SalesOrder::SOURCE_WEBSITE);
                    $weborder = $this->muffsWms->getWeborderRepository()->getOrder($salesOrder->getWebsiteId());
                    $this->loadOrderFromWms($salesOrder, $weborder);
                } else {
                    $salesOrder->setSource(SalesOrder::SOURCE_CSR);
                }

                $result[] = $salesOrder;
            }

            $offset += $limit;
        } while (count($erpOrders) > 0);

        return $result;
    }

    private function loadOrderFromWms(SalesOrder $order, Weborder $weborder) {

        $order->setWebsiteOrderDate($weborder->getOrderDate())
                ->setWebsiteNotes($weborder->getNotes());

        if (count($weborder->getShipments()) > 0) {
            $order->setShippingDate($weborder->getShipments()[0]->getShippingDate());
        }

        return $order;
    }

    private function loadOrderFromErp(SalesOrder $order, SalesOrder2 $erpOrder) {

        $order->setCustomerNumber($erpOrder->getCustomerNumber())
                ->setCustomerPurchaseOrder($erpOrder->getCustomerPurchaseOrder())
                ->setOpen($erpOrder->getOpen())
                ->setOrderDate($erpOrder->getOrderDate())
                ->setOrderNumber($erpOrder->getOrderNumber())
                ->setRecordSequence($erpOrder->getRecordSequence())
                ->setShipToAddress1($erpOrder->getShipToAddress1())
                ->setShipToAddress2($erpOrder->getShipToAddress2())
                ->setShipToAddress3($erpOrder->getShipToAddress3())
                ->setShipToCity($erpOrder->getShipToCity())
                ->setShipToCountry($erpOrder->getShipToCountry())
                ->setShipToEmail($erpOrder->getShipToEmail())
                ->setShipToName($erpOrder->getShipToName())
                ->setShipToPhone($erpOrder->getShipToPhone())
                ->setShipToState($erpOrder->getShipToState())
                ->setShipToZip($erpOrder->getShipToZip())
                ->setShipViaCode($erpOrder->getShipViaCode())
                ->setStatus($erpOrder->getStatus())
                ->setWebReferenceNumber($erpOrder->getWebReferenceNumber());

        $order->setCartons($this->getCartons($order->getOrderNumber()));

        return $order;
    }

    public function findOpenOrders() {

        $limit = 1000;
        $offset = 0;

        $response = [];

        do {
            $orders = $this->erp->getSalesOrderRepository()->findOpen($limit, $offset)->getSalesOrders();
            foreach ($orders as $order) {
                $salesOrder = new SalesOrder();
                $this->loadOrderFromErp($salesOrder, $order);
                $response[] = $salesOrder;
            }
            $offset += $limit;
        } while (count($orders) > 0);

        return $response;
    }

    public function findOpenShipments() {

        $response = [];

        $limit = 1000;
        $offset = 0;

        do {
            $shipments = $this->erp->getShipmentRepository()->findOpen($limit, $offset)->getShipments();

            foreach ($shipments as $shipment) {
                $response[] = $shipment;
            }

            $offset += $limit;
        } while (count($shipments) > 0);

        return $response;
    }

    /**
     * 
     * @param int $orderNumber
     * @param int $recordSequence
     * @return Shipment[]
     */
    public function getShipment($orderNumber, $recordSequence = 1) {
        return $this->erp->getShipmentRepository()->get($orderNumber, $recordSequence);
    }

    /**
     * 
     * @param int $orderNumber
     * @param int $recordSequence
     * @return ShipmentItem[]
     */
    public function getShipmentItems($orderNumber, $recordSequence = 1) {
        return $this->erp->getShipmentRepository()->getItems($orderNumber, $recordSequence)->getItems();
    }

    /**
     * 
     * @param SalesOrder $order
     * @param SalesOrderItemCollection $items
     * @return boolean
     */
    public function submitOrder(SalesOrder $order, SalesOrderItemCollection $items) {
        return $this->erp->getSalesOrderRepository()->submitOrder($order, $items);
    }

}
