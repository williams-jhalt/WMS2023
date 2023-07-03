<?php

namespace App\Tests\Service;

use App\Model\ConnectShip\Package;
use App\Model\Erp\InvoiceItem;
use App\Model\Erp\InvoiceItemCollection;
use App\Model\Erp\ShipmentPackage;
use App\Model\Erp\ShipmentPackageCollection;
use App\Service\ConnectshipService;
use App\Service\WmsService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Model\Erp\Invoice;
use App\Model\Erp\Shipment;
use App\Model\Erp\InvoiceCollection;
use App\Service\ErpService;
use App\Repository\Erp\InvoiceRepository;
use App\Repository\Erp\ShipmentRepository;
use App\Service\ExportService;
use DateTime;
use SplFileInfo;

class ExportServiceTest extends KernelTestCase
{
    public function testExportInvoiceData(): void
    {
        $kernel = self::bootKernel();

        $testInvoice = new Invoice();
        $testInvoice->setInvoiceNumber("TEST001");
        $testInvoice->setInvoiceDate(new DateTime("2023-06-28"));
        $testInvoice->setGrossInvoiceAmount("5.00");
        $testInvoice->setNetInvoiceAmount("10.00");
        $testInvoice->setShippingAndHandling("3.00");
        $testInvoice->setFreightCharge("5.00");

        $invoiceCollection = new InvoiceCollection([
            $testInvoice
        ]);
        $invoiceCollection2 = new InvoiceCollection(array());

        $mockInvoiceRepository = $this->createMock(InvoiceRepository::class);
        $mockInvoiceRepository->expects($this->exactly(2))
            ->method('findByCustomerAndDate')
            ->willReturnOnConsecutiveCalls(
                $invoiceCollection,
                $invoiceCollection2
            );

        $testInvoiceItem = new InvoiceItem();
        $testInvoiceItem->setItemNumber("TEST");

        $mockInvoiceRepository->expects($this->once())
            ->method('getItems')
            ->willReturn(new InvoiceItemCollection([$testInvoiceItem]));

        $testShipment = new Shipment();
        $testShipment->setCustomerNumber("TEST001");
        $testShipment->setCustomerPurchaseOrder("blahblah");
        $testShipment->setManifestId("foo");

        $testShipmentPackage = new ShipmentPackage();
        $testShipmentPackage->setFreightCost("5.00");

        $mockShipmentRepository = $this->createMock(ShipmentRepository::class);

        $mockShipmentRepository->expects($this->once())
            ->method('get')
            ->willReturn($testShipment);

        $mockShipmentRepository->expects($this->once())
            ->method('getPackages')
            ->willReturn(new ShipmentPackageCollection([$testShipmentPackage]));

        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->once())
            ->method('getInvoiceRepository')
            ->willReturn($mockInvoiceRepository);

        $mockErpService->expects($this->once())
            ->method('getShipmentRepository')
            ->willReturn($mockShipmentRepository);

        $mockConnectshipService = $this->createMock(ConnectshipService::class);
        $mockWmsService = $this->createMock(WmsService::class);

        $container = static::getContainer();
        $container->set(ConnectshipService::class, $mockConnectshipService);
        $container->set(WmsService::class, $mockWmsService);
        $container->set(ErpService::class, $mockErpService);

        $exportService = $container->get(ExportService::class);

        $tmpHeaderFile = tempnam(__DIR__, "test_invoice_header");
        $tmpDetailFile = tempnam(__DIR__, "test_invoice_detail");
        
        $headerFile = new SplFileInfo($tmpHeaderFile);
        $detailFile = new SplFileInfo($tmpDetailFile);

        $exportService->exportInvoiceData(
                "TEST001", 
                new DateTime("2023-06-28"), 
                new DateTime("2023-06-28"), 
                false,
                $headerFile,
                $detailFile
        );

        $this->assertSame('test', $kernel->getEnvironment());
        $this->assertFileEquals(__DIR__ . '/test_invoice_header.csv', $tmpHeaderFile);
        $this->assertFileEquals(__DIR__ . '/test_invoice_detail.csv', $tmpDetailFile);        

        unlink($headerFile);
        unlink($detailFile);
    }

    public function testExportShippingData(): void
    {
        $kernel = self::bootKernel();

        $mockConnectshipService = $this->createMock(ConnectshipService::class);
        $mockConnectshipService->expects($this->once())
            ->method('getShippingDataByDate')
            ->willReturn([
                new Package()
            ]);

        $mockWmsService = $this->createMock(WmsService::class);
        $mockErpService = $this->createMock(ErpService::class);

        $container = static::getContainer();
        $container->set(ConnectshipService::class, $mockConnectshipService);
        $container->set(WmsService::class, $mockWmsService);
        $container->set(ErpService::class, $mockErpService);

        $container = static::getContainer();
        
        $exportService = $container->get(ExportService::class);
        
        $outputFile = new SplFileInfo(tempnam(__DIR__, "test_invoice_header"));

        $exportService->exportShippingData(
            new DateTime("2023-06-28"),
            new DateTime("2023-06-28"),
            $outputFile
        );


        $this->assertSame('test', $kernel->getEnvironment());
        $this->assertFileEquals(__DIR__ . '/test_shipment.csv', $outputFile);

        unlink($outputFile);

    }


}
