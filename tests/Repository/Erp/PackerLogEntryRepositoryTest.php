<?php

namespace App\Tests\Repository\Erp;

use PHPUnit\Framework\TestCase;
use App\Repository\Erp\PackerLogEntryRepository;
use App\Service\ErpService;

class PackerLogEntryRepositoryTest extends TestCase
{
    public function testFindByStartDateAndEndDate(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'user_id' => "TEST",
                'ucc' => "TEST",
                'qty_shp' => 1
            ]]);

        $productRepository = new PackerLogEntryRepository($mockErpService);
        $result = $productRepository->findByStartDateAndEndDate(new \DateTime("yesterday"), new \DateTime("now"), 1000, 0);
        $items = $result->getPackerLogEntries();
        
        $this->assertSame(1, $items[0]->getQtyShipped());
    }

    public function testFindByUcc(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'user_id' => "TEST",
                'ucc' => "TEST",
                'qty_shp' => 1
            ]]);

        $productRepository = new PackerLogEntryRepository($mockErpService);
        $result = $productRepository->findByUcc("TEST", 1000, 0);
        $items = $result->getPackerLogEntries();
        
        $this->assertSame(1, $items[0]->getQtyShipped());
    }

    public function testFindByUserId(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'user_id' => "TEST",
                'ucc' => "TEST",
                'qty_shp' => 1
            ]]);

        $productRepository = new PackerLogEntryRepository($mockErpService);
        $result = $productRepository->findByUserId("TEST", 1000, 0);
        $items = $result->getPackerLogEntries();
        
        $this->assertSame(1, $items[0]->getQtyShipped());
    }
}
