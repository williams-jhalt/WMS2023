<?php

namespace App\Tests\Repository\Erp;

use App\Repository\Erp\CustomerRepository;
use PHPUnit\Framework\TestCase;
use App\Service\ErpService;

class CustomerRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'customer_customer' => "TEST",
                'customer_name' => "TEST"
            ]]);

        $productRepository = new CustomerRepository($mockErpService);
        $result = $productRepository->findAll(1000, 0);
        $products = $result->getCustomers();
        
        $this->assertSame("TEST", $products[0]->getCustomerNumber());
    }
    
    public function testFindByTextSearch(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'customer_customer' => "TEST",
                'customer_name' => "TEST"
            ]]);

        $productRepository = new CustomerRepository($mockErpService);
        $result = $productRepository->findByTextSearch("TEST", 1000, 0);
        $products = $result->getCustomers();
        
        $this->assertSame("TEST", $products[0]->getCustomerNumber());
    }
    
    public function testGetByCustomerNumber(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'customer_customer' => "TEST",
                'customer_name' => "TEST"
            ]]);

        $productRepository = new CustomerRepository($mockErpService);
        $result = $productRepository->getByCustomerNumber("TEST");
        
        $this->assertSame("TEST", $result->getCustomerNumber());
    }
}
