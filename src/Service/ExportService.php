<?php

namespace App\Service;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use SplFileInfo;
use SplFileObject;
use App\Service\ConnectshipService;
use App\Service\ErpServerService as ErpService;
use App\Service\WmsService;

class ExportService {

    /**
     *
     * @var ErpService
     */
    private $erp;

    /**
     *
     * @var ConnectshipService
     */
    private $connectship;

    /**
     *
     * @var WmsService
     */
    private $muffsWms;

    /**
     *
     * @var WmsService
     */
    private $williamsWms;

    /**
     *
     * @var EntityManager
     */
    private $em;

    public function __construct(ErpService $erp, ConnectshipService $connectship, WmsService $muffsWms, WmsService $williamsWms, EntityManagerInterface $em) {
        $this->erp = $erp;
        $this->connectship = $connectship;
        $this->muffsWms = $muffsWms;
        $this->williamsWms = $williamsWms;
        $this->em = $em;
    }

    /**
     * 
     * @param string $customerNumber
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param bool $consolidated
     * @param SplFileInfo $headerFile
     * @param SplFileInfo $detailFile
     */
    public function exportInvoiceData(string $customerNumber, DateTime $startDate, DateTime $endDate, bool $consolidated, SplFileInfo $headerFile, SplFileInfo $detailFile) {

        $repo = $this->erp->getInvoiceRepository();
        $shipmentRepo = $this->erp->getShipmentRepository();

        $headerFh = $headerFile->openFile("wb");
        $detailFh = $detailFile->openFile("wb");

        $headerFh->fputcsv(['orderNumber', 'recordSequence', 'webReferenceNumber', 'customerReferenceNumber', 'invoiceDate', 'customerNumber', 'grossInvoiceAmount', 'shippingAndHandling', 'freightCharge', 'netInvoiceAmount', 'trackingNumber', 'shippingMethod']);
        $detailFh->fputcsv(['orderNumber', 'recordSequence', 'itemNumber', 'qtyOrdered', 'qtyBilled', 'unitOfMeasure', 'price']);

        $offset = 0;
        $limit = 1000;

        do {
            $invoices = $repo->findByCustomerAndDate($customerNumber, $startDate, $endDate, $consolidated, $limit, $offset)->getInvoices();
            foreach ($invoices as $invoice) {

                if ($invoice->getOpen()) {
                    continue;
                }

                $packages = $shipmentRepo->getPackages($invoice->getOrderNumber())->getShipmentPackages();
                $shipment = $shipmentRepo->get($invoice->getOrderNumber(), $invoice->getRecordSequence());

                $trackingNumber = "";

                for ($i = 0; $i < count($packages); $i++) {
                    if ($i > 0) {
                        $trackingNumber .= ",";
                    }
                    $trackingNumber .= $packages[$i]->getTrackingNumber();
                }

                $headerFh->fputcsv([
                    $invoice->getOrderNumber(),
                    $invoice->getRecordSequence(),
                    $invoice->getWebReferenceNumber(),
                    $invoice->getCustomerPurchaseOrder(),
                    $invoice->getInvoiceDate()->format('m/d/Y'),
                    $invoice->getCustomerNumber(),
                    $invoice->getGrossInvoiceAmount(),
                    $invoice->getShippingAndHandling(),
                    $invoice->getFreightCharge(),
                    $invoice->getNetInvoiceAmount(),
                    $trackingNumber,
                    $shipment->getShipViaCode()
                ]);

                $items = $repo->getItems($invoice->getOrderNumber(), $invoice->getRecordSequence())->getItems();

                foreach ($items as $item) {
                    $detailFh->fputcsv([
                        $invoice->getOrderNumber(),
                        $invoice->getRecordSequence(),
                        $item->getItemNumber(),
                        $item->getQuantityOrdered(),
                        $item->getQuantityBilled(),
                        $item->getUnitOfMeasure(),
                        $item->getPrice()
                    ]);
                }
            }
            $offset += $limit;
        } while (count($invoices) > 0);

        $headerFh = null;
        $detailFh = null;
    }

    /**
     * 
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param SplFileInfo $outputFile
     */
    public function exportShippingData(DateTime $startDate, DateTime $endDate, SplFileInfo $outputFile) {

        $packages = $this->connectship->getShippingDataByDate($startDate, $endDate);

        $outputFh = $outputFile->openFile("wb");

        $outputFh->fputcsv([
            'shippingMethod',
            'height',
            'length',
            'width',
            'weight',
            'total',
            'zip',
            'state',
            'country',
            'shipDate'
        ]);
        
        foreach ($packages as $package) {
            $outputFh->fputcsv([
                $package->getShippingMethod(),
                $package->getHeight(),
                $package->getLength(),
                $package->getWidth(),
                $package->getWeight(),
                $package->getFreightCharge(),
                $package->getConsigneePostalCode(),
                $package->getConsigneeState(),
                $package->getConsigneeCountry(),
                $package->getShipDate()
            ]);
        }

        $outputFh = null;
    }

    /**
     * Exports invoices and uploads them to specified FTP server
     * 
     * Uploaded files will be named $customerNumber_YYYYMMDD_header.csv
     * and $customerNumber_YYYYMMDD_detail.csv
     * 
     * @param string $customerNumber
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param string $hostname
     * @param string $username
     * @param string $password
     */
    public function uploadInvoicesToFtp($customerNumber, DateTime $startDate, DateTime $endDate, $hostname, $username, $password, $destination = "") {

        $headerFile = new SplFileInfo(tempnam(sys_get_temp_dir(), 'exh'));
        $detailFile = new SplFileInfo(tempnam(sys_get_temp_dir(), 'exd'));

        $this->exportInvoiceData($customerNumber, $startDate, $endDate, false, $headerFile, $detailFile);

        $headerFileName = $destination . $customerNumber . "_" . $startDate->format('Ymd') . "_" . $endDate->format('Ymd') . "_header.csv";
        $detailFileName = $destination . $customerNumber . "_" . $startDate->format('Ymd') . "_" . $endDate->format('Ymd') . "_detail.csv";

        $ftp = ftp_connect($hostname);
        ftp_login($ftp, $username, $password);
        ftp_pasv($ftp, true);
        ftp_put($ftp, $headerFileName, $headerFile->getPathname(), FTP_ASCII);
        ftp_put($ftp, $detailFileName, $detailFile->getPathname(), FTP_ASCII);
        ftp_close($ftp);

        unlink($headerFile->getPathname());
        unlink($detailFile->getPathname());
    }

}
