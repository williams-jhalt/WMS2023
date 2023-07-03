<?php

namespace App\Tests\Repository\Erp;

use App\Model\Erp\Order;
use App\Model\Erp\OrderItem;
use App\Model\Erp\Product;
use App\Repository\Erp\ProductRepository;
use PHPUnit\Framework\TestCase;
use App\Repository\Erp\SalesOrderRepository;
use App\Service\ErpService;

class SalesOrderRepositoryTest extends TestCase
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
                'invc_seq' => 1,
                'invoice' => "TEST",
                'opn' => "1",
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'residential' => true,
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'source_code' => "TEST"
            ]]);

        $productRepository = new SalesOrderRepository($mockErpService);
        $result = $productRepository->findAll(1000, 0);
        $items = $result->getSalesOrders();
        
        $this->assertSame("TEST", $items[0]->getCustomerNumber());
    }

    public function testFindOpen(): void
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
                'invc_seq' => 1,
                'invoice' => "TEST",
                'opn' => "1",
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'residential' => true,
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'source_code' => "TEST"
            ]]);

        $productRepository = new SalesOrderRepository($mockErpService);
        $result = $productRepository->findOpen(1000, 0);
        $items = $result->getSalesOrders();
        
        $this->assertSame("TEST", $items[0]->getCustomerNumber());
    } 
    
    public function testFindByTextSearch(): void
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
                'invc_seq' => 1,
                'invoice' => "TEST",
                'opn' => "1",
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'residential' => true,
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'source_code' => "TEST"
            ]]);

        $productRepository = new SalesOrderRepository($mockErpService);
        $result = $productRepository->findByTextSearch("TEST");
        $items = $result->getSalesOrders();
        
        $this->assertSame("TEST", $items[0]->getCustomerNumber());
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
                'invc_seq' => 1,
                'invoice' => "TEST",
                'opn' => "1",
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'residential' => true,
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'source_code' => "TEST"
            ]]);

        $productRepository = new SalesOrderRepository($mockErpService);
        $result = $productRepository->get("TEST");
        
        $this->assertSame("TEST", $result->getCustomerNumber());
    }

    public function testGetByWebReferenceNumberAndCustomerNumber(): void
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
                'invc_seq' => 1,
                'invoice' => "TEST",
                'opn' => "1",
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'residential' => true,
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'source_code' => "TEST"
            ]]);

        $productRepository = new SalesOrderRepository($mockErpService);
        $result = $productRepository->findByTextSearch("TEST");
        $items = $result->getSalesOrders();
        
        $this->assertSame("TEST", $items[0]->getCustomerNumber());
    }

    public function testGetItems(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'line' => 1,
                'item' => "TEST",
                'q_ord' => 2
            ]]);

        $productRepository = new SalesOrderRepository($mockErpService);
        $result = $productRepository->getItems("TEST");
        $items = $result->getItems();
        
        $this->assertSame("TEST", $items[0]->getItemNumber());
    }
    
    public function testSubmitOrder(): void
    {

        $testOrderItem = new OrderItem();
        $testOrderItem->setItemNumber("TEST");

        $testOrder = new Order();
        $testOrder->setCustomerNumber("TEST");
        $testOrder->setItems([
            $testOrderItem
        ]);

        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('create')
            ->with(
                $this->anything(),
                $this->anything(),
                $this->anything()
            );

        $mockProduct = new Product();
        $mockProduct->setItemNumber("TEST");

        $mockProductRepository = $this->createMock(ProductRepository::class);
        $mockProductRepository->expects($this->any())
            ->method('getByItemNumber')
            ->willReturn($mockProduct);

        $mockErpService->expects($this->any())
            ->method('getProductRepository')
            ->willReturn($mockProductRepository);

        $productRepository = new SalesOrderRepository($mockErpService);
        $result = $productRepository->submitOrder($testOrder);
        
        $this->assertTrue($result);
    }
}
