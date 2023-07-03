<?php

namespace App\Tests\Repository\Erp;

use App\Repository\Erp\ProductRepository;
use App\Service\ErpService;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'item_item' => "TEST",
                'item_descr' => ["TEST"],
                'wa_item_ship_location' => "TEST",
                'wa_item_list_price' => "TEST",
                'wa_item_qty_cmtd' => "TEST",
                'wa_item_qty_oh' => "TEST",
                'item_original_release_date' => "2023-6-29",
                'item_date_added' => "2023-6-29",
                'item_manufacturer' => "TEST",
                'item_product_line' => "TEST",
                'item_is_deleted' => "TEST",
                'item_web_item' => "TEST",
                'wa_item_warehouse' => "TEST",
                'item_um_display' => "TEST",
                'item_upc1' => "TEST"
            ]]);

        $productRepository = new ProductRepository($mockErpService);
        $result = $productRepository->findAll(1000, 0);
        $products = $result->getProducts();
        
        $this->assertSame("TEST", $products[0]->getItemNumber());
    }
    
    public function testFindByTextSearch(): void
    {
        
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'item_item' => "TEST",
                'item_descr' => ["TEST"],
                'wa_item_ship_location' => "TEST",
                'wa_item_list_price' => "TEST",
                'wa_item_qty_cmtd' => "TEST",
                'wa_item_qty_oh' => "TEST",
                'item_original_release_date' => "2023-6-29",
                'item_date_added' => "2023-6-29",
                'item_manufacturer' => "TEST",
                'item_product_line' => "TEST",
                'item_is_deleted' => "TEST",
                'item_web_item' => "TEST",
                'wa_item_warehouse' => "TEST",
                'item_um_display' => "TEST",
                'item_upc1' => "TEST"
            ]]);

        $productRepository = new ProductRepository($mockErpService);
        $result = $productRepository->findByTextSearch("TEST", 1000, 0);
        $products = $result->getProducts();

        $this->assertSame("TEST", $products[0]->getItemNumber());
    }
    
    public function getByItemNumber(): void
    {

        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'item_item' => "TEST",
                'item_descr' => ["TEST"],
                'wa_item_ship_location' => "TEST",
                'wa_item_list_price' => "TEST",
                'wa_item_qty_cmtd' => "TEST",
                'wa_item_qty_oh' => "TEST",
                'item_original_release_date' => "2023-6-29",
                'item_date_added' => "2023-6-29",
                'item_manufacturer' => "TEST",
                'item_product_line' => "TEST",
                'item_is_deleted' => "TEST",
                'item_web_item' => "TEST",
                'wa_item_warehouse' => "TEST",
                'item_um_display' => "TEST",
                'item_upc1' => "TEST"
            ]]);

        $productRepository = new ProductRepository($mockErpService);
        $result = $productRepository->getByItemNumber("TEST");

        $this->assertSame("TEST", $result->getItemNumber());
    }
    
    public function testFindCommittedItems(): void
    {

        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'item_item' => "TEST",
                'item_descr' => ["TEST"],
                'wa_item_ship_location' => "TEST",
                'wa_item_list_price' => "TEST",
                'wa_item_qty_cmtd' => "TEST",
                'wa_item_qty_oh' => "TEST",
                'item_original_release_date' => "2023-6-29",
                'item_date_added' => "2023-6-29",
                'item_manufacturer' => "TEST",
                'item_product_line' => "TEST",
                'item_is_deleted' => "TEST",
                'item_web_item' => "TEST",
                'wa_item_warehouse' => "TEST",
                'item_um_display' => "TEST",
                'item_upc1' => "TEST"
            ]]);

        $productRepository = new ProductRepository($mockErpService);
        $result = $productRepository->findCommittedItems(1000, 0);
        $products = $result->getProducts();

        $this->assertSame("TEST", $products[0]->getItemNumber());
    }
}
