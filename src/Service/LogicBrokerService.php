<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use App\Adapter\LogicBroker\CsvInventoryAdapter;
use App\Adapter\LogicBroker\CsvInvoiceAdapter;
use App\Adapter\LogicBroker\CsvOrderAdapter;
use App\Adapter\LogicBroker\CsvShipmentAdapter;
use App\Entity\LogicBrokerOrderStatus;
use App\Service\LogicBrokerHandlerInterface;
use SplFileObject;

class LogicBrokerService {

    /**
     *
     * @var string
     */
    private $ftpHost;

    /**
     *
     * @var string
     */
    private $ftpUser;

    /**
     *
     * @var string
     */
    private $ftpPass;

    /**
     *
     * @var LogicBrokerHandlerInterface
     */
    private $handler;

    /**
     *
     * @var EntityManager
     */
    private $em;

    public function __construct(string $ftpHost, string $ftpUser, string $ftpPass, LogicBrokerHandlerInterface $handler, EntityManagerInterface $em) {
        $this->ftpHost = $ftpHost;
        $this->ftpUser = $ftpUser;
        $this->ftpPass = $ftpPass;
        $this->handler = $handler;
        $this->em = $em;
    }

    public function retrieveOrders() {

        $adapter = new CsvOrderAdapter();

        $ftp = ftp_connect($this->ftpHost);
        $login = ftp_login($ftp, $this->ftpUser, $this->ftpPass);

        if ((!$ftp) || (!$login)) {
            throw new Exception("Could Not Connect to FTP");
        }

        $files = ftp_nlist($ftp, "/CSV/Inbound/Order");

        if (empty($files)) {
            return false;
        }

        foreach ($files as $file) {
            $tempfile = tempnam(sys_get_temp_dir(), "lb");
            ftp_get($ftp, $tempfile, $file, FTP_ASCII);
            $fh = new SplFileObject($tempfile, "rb");
            $orders = $adapter->read($fh);
            foreach ($orders as $order) {

                // translate the sender id to a customer number
                $repo = $this->em->getRepository('LogicBrokerBundle:Customer');
                $customerNumber = $repo->findOneBySenderCompanyId($order->getSenderCompanyId())->getCustomerNumber();

                // submit order using handler
                $weborderNumber = $this->handler->submitOrder($order, $customerNumber);

                // record transaction
                $status = new OrderStatus();
                $status->setCustomerNumber($customerNumber);
                $status->setDocumentDate($order->getDocumentDate());
                $status->setLogicBrokerKey($order->getIdentifier()->getLogicBrokerKey());
                $status->setLinkKey($order->getIdentifier()->getLinkKey());
                $status->setOrderDate($order->getOrderDate());
                $status->setPartnerPO($order->getPartnerPO());
                $status->setSenderCompanyId($order->getSenderCompanyId());
                $status->setStatusCode(150);
                $status->setWeborderNumber($weborderNumber);
                $this->em->persist($status);
            }
            $this->em->flush();

            @ftp_delete($ftp, $file);

            $fh = null;

            unlink($tempfile);
        }

        return $orders;
    }

    /**
     * Check that orders have been entered into ERP
     */
    public function acknowledgeReceipt() {

        $repo = $this->em->getRepository('LogicBrokerBundle:OrderStatus');
        $orderStatus = $repo->findByStatusCode(150);
        foreach ($orderStatus as $status) {
            $orderNumber = $this->handler->retrieveOrderNumber($status);
            if ($orderNumber !== null) {
                $status->setOrderNumber($orderNumber);
                $status->setStatusCode(500);
                $this->em->persist($status);
            }
        }
        $this->em->flush();
    }

    /**
     * Submit shipments to LogicBroker
     */
    public function submitShipments() {

        $tempFile = tempnam(sys_get_temp_dir(), "lb");

        $file = new SplFileObject($tempFile, "wb");

        $adapter = new CsvShipmentAdapter();

        $adapter->writeHeader($file);

        $repo = $this->em->getRepository('LogicBrokerBundle:OrderStatus');
        $orderStatus = $repo->findByStatusCode(500);
        $count = 0;
        foreach ($orderStatus as $status) {
            $shipments = $this->handler->getShipments($status);
            $count += count($shipments);
            if (count($shipments) > 0) {
                $adapter->writeData($shipments, $file);
                $status->setStatusCode(600);
                $this->em->persist($status);
            }
        }
        
        $file->fflush();

        $file = null;

        if ($count == 0) {
            unlink($tempFile);
            return false;
        }

        $this->cleanCsv($tempFile);

        $ftp = ftp_connect($this->ftpHost);
        $login = ftp_login($ftp, $this->ftpUser, $this->ftpPass);

        if ((!$ftp) || (!$login)) {
            throw new Exception("Could Not Connect to FTP");
        }

        $filename = date("Ymdhis") . "_shipments.csv";

        ftp_put($ftp, "/CSV/Outbound/ExtendedShipment/$filename", $tempFile, FTP_ASCII);

        $this->em->flush();

        unlink($tempFile);
    }

    /**
     * Submit invoices to LogicBroker
     */
    public function submitInvoices() {

        $tempFile = tempnam(sys_get_temp_dir(), "lb");

        $file = new SplFileObject($tempFile, "wb");

        $adapter = new CsvInvoiceAdapter();

        $adapter->writeHeader($file);

        $repo = $this->em->getRepository('LogicBrokerBundle:OrderStatus');
        $orderStatus = $repo->findByStatusCode(600);
        $count = 0;
        foreach ($orderStatus as $status) {
            $invoices = $this->handler->getInvoices($status);
            $count += count($invoices);
            if (count($invoices) > 0) {
                $adapter->writeData($invoices, $file);
                $status->setStatusCode(1000);
                $this->em->persist($status);
            }
        }
        
        $file->fflush();

        $file = null;

        if ($count == 0) {
            unlink($tempFile);
            return false;
        }

        $this->cleanCsv($tempFile);

        $ftp = ftp_connect($this->ftpHost);
        $login = ftp_login($ftp, $this->ftpUser, $this->ftpPass);

        if ((!$ftp) || (!$login)) {
            throw new Exception("Could Not Connect to FTP");
        }

        $filename = date("Ymdhis") . "_invoices.csv";

        ftp_put($ftp, "/CSV/Outbound/Invoice/$filename", $tempFile, FTP_ASCII);

        $this->em->flush();

        unlink($tempFile);
    }

    public function updateInventory() {

        $tempFile = tempnam(sys_get_temp_dir(), "lb");

        $file = new SplFileObject($tempFile, "wb");

        $adapter = new CsvInventoryAdapter($file);

        $adapter->writeHeader();

        $this->handler->writeInventory($adapter);
        
        $file->fflush();

        $file = null;
        
        $this->cleanCsv($tempFile);

        $ftp = ftp_connect($this->ftpHost);
        $login = ftp_login($ftp, $this->ftpUser, $this->ftpPass);

        if ((!$ftp) || (!$login)) {
            throw new Exception("Could Not Connect to FTP");
        }

        $filename = date("Ymdhis") . "_inventory.csv";
        
        $customers = $this->em->getRepository('LogicBrokerBundle:Customer')->findAll();
        
        foreach ($customers as $customer) {
            
            $partnerid = $customer->getSenderCompanyId();

            ftp_put($ftp, "/ManagedInventory/$partnerid/Outbound/$filename", $tempFile, FTP_ASCII);
        
        }

        unlink($tempFile);
    }

    public function customerNumberToSenderCompanyId($customerNumber) {
        $customer = $this->em->getRepository('LogicBroker:Customer')->findOneByCustomerNumber($customerNumber);
        if ($customer === null) {
            return null;
        }
        return $customer->getSenderCompanyId();
    }

    public function senderCompanyIdToCustomerNumber($senderCompanyId) {
        $customer = $this->em->getRepository('LogicBroker:Customer')->findOneBySenderCompanyId($senderCompanyId);
        if ($customer === null) {
            return null;
        }
        return $customer->getCustomerNumber();
    }

    /**
     * Remove empty columns from a CSV file
     * 
     * @param string $inputFile
     */
    public function cleanCsv($inputFile) {
        
        $tmpfile = tempnam(sys_get_temp_dir(), "lb");

        $file = new SplFileObject($inputFile, "rb");
        $out = new SplFileObject($tmpfile, "wb");

        $populatedFields = [];

        $file->rewind();
        $line = 0;
        while (!$file->eof()) {
            $row = $file->fgetcsv();
            if ($line++ == 0) {
                continue;
            }
            foreach ($row as $key => $value) {
                if (!isset($populatedFields[$key])) {
                    $populatedFields[$key] = false; // initialize key
                }
                if (!$populatedFields[$key]) {
                    $populatedFields[$key] = !empty($value); // if it's not empty set to true
                }
            }
        }
        
        $file->rewind();
        while (!$file->eof()) {
            $row = $file->fgetcsv();
            $data = [];
            foreach ($populatedFields as $key => $value) {
                if ($value && isset($row[$key])) {
                    $data[] = $row[$key];
                }
            }
            $out->fputcsv($data);
        }
        
        $out->fflush();

        $file = null;
        $out = null;
        
        rename($tmpfile, $inputFile);
    }

}
