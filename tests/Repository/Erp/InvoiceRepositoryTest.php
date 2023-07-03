<?php

namespace App\Tests\Repository\Erp;

use PHPUnit\Framework\TestCase;
use App\Repository\Erp\InvoiceRepository;
use App\Service\ErpService;

class InvoiceRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'adr' => ["TEST", "TEST", "TEST", "TEST"],
                'customer' => "TEST",
                'cu_po' => "TEST",
                'c_tot_code_amt' => ["TEST", "TEST"],
                'c_tot_gross' => "TEST",
                'c_tot_net_ar' => "TEST",
                'email' => "TEST",
                'invc_date' => "2023-6-29",
                'invoice' => "TEST",
                'opn' => "1",
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST"
            ]]);

        $productRepository = new InvoiceRepository($mockErpService);
        $result = $productRepository->findAll(1000, 0);
        $invoices = $result->getInvoices();
        
        $this->assertSame("TEST", $invoices[0]->getCustomerNumber());
    }

    public function testFindByCustomerAndDate(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'adr' => ["TEST", "TEST", "TEST", "TEST"],
                'customer' => "TEST",
                'cu_po' => "TEST",
                'c_tot_code_amt' => ["TEST", "TEST"],
                'c_tot_gross' => "TEST",
                'c_tot_net_ar' => "TEST",
                'email' => "TEST",
                'invc_date' => "2023-6-29",
                'invoice' => "TEST",
                'opn' => "1",
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST"
            ]]);

        $productRepository = new InvoiceRepository($mockErpService);
        $result = $productRepository->findByCustomerAndDate("TEST", new \DateTime("yesterday"), new \DateTime("now"), false, 1000, 0);
        $invoices = $result->getInvoices();
        
        $this->assertSame("TEST", $invoices[0]->getCustomerNumber());
    }

    public function testFindByOrderNumber(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'adr' => ["TEST", "TEST", "TEST", "TEST"],
                'customer' => "TEST",
                'cu_po' => "TEST",
                'c_tot_code_amt' => ["TEST", "TEST"],
                'c_tot_gross' => "TEST",
                'c_tot_net_ar' => "TEST",
                'email' => "TEST",
                'invc_date' => "2023-6-29",
                'invoice' => "TEST",
                'opn' => "1",
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST"
            ]]);

        $productRepository = new InvoiceRepository($mockErpService);
        $result = $productRepository->findByOrderNumber("TEST");
        $invoices = $result->getInvoices();
        
        $this->assertSame("TEST", $invoices[0]->getCustomerNumber());
    }

    public function testGet(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'adr' => ["TEST", "TEST", "TEST", "TEST"],
                'customer' => "TEST",
                'cu_po' => "TEST",
                'c_tot_code_amt' => ["TEST", "TEST"],
                'c_tot_gross' => "TEST",
                'c_tot_net_ar' => "TEST",
                'email' => "TEST",
                'invc_date' => "2023-6-29",
                'invoice' => "TEST",
                'opn' => "1",
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST"
            ]]);

        $productRepository = new InvoiceRepository($mockErpService);
        $result = $productRepository->get("TEST");
        
        $this->assertSame("TEST", $result->getCustomerNumber());
    }
    
    public function testGetItems(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'line' => 1,
                'item' => "TEST",
                'q_itd' => 1,
                'q_ord' => 2,
                'price' => 3,
                'um_o' => "EA"
            ]]);

        $productRepository = new InvoiceRepository($mockErpService);
        $result = $productRepository->getItems("TEST", 1);
        $items = $result->getItems();
        
        $this->assertSame(1, $items[0]->getLineNumber());
    }
}
