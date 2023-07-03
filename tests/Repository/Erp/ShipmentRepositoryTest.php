<?php

namespace App\Tests\Repository\Erp;

use PHPUnit\Framework\TestCase;
use App\Repository\Erp\ShipmentRepository;
use App\Service\ErpService;
use DateTime;

class ShipmentRepositoryTest extends TestCase
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
                'email' => "TEST",
                'opn' => 1,
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'Manifest_id' => "TEST",
                'num_pages' => 1,
                'ship_date' => "2023-6-29"
            ]]);

        $repository = new ShipmentRepository($mockErpService);
        $result = $repository->findAll(1000, 0);
        $items = $result->getShipments();
        
        $this->assertSame("TEST", $items[0]->getCustomerNumber());
    }
    
    public function testFindByShippingDate(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturn([(object) [
                'adr' => ["TEST", "TEST", "TEST", "TEST"],
                'customer' => "TEST",
                'cu_po' => "TEST",
                'email' => "TEST",
                'opn' => 1,
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'Manifest_id' => "TEST",
                'num_pages' => 1,
                'ship_date' => "2023-6-29"
            ]]);

        $repository = new ShipmentRepository($mockErpService);
        $result = $repository->findByShippingDate(new DateTime("yesterday"), new DateTime("now"), 1000, 0);
        $items = $result->getShipments();
        
        $this->assertSame("TEST", $items[0]->getCustomerNumber());
    }

    public function testGetByUcc(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturnOnConsecutiveCalls(
                [(object) [
                    'order' => "TEST"
                ]],
                [(object) [
                    'adr' => ["TEST", "TEST", "TEST", "TEST"],
                    'customer' => "TEST",
                    'cu_po' => "TEST",
                    'email' => "TEST",
                    'opn' => 1,
                    'order' => "TEST",
                    'ord_date' => "2023-6-29",
                    'ord_ext' => "TEST",
                    'phone' => "TEST",
                    'rec_seq' => "TEST",
                    'ship_via_code' => "TEST",
                    'stat' => "TEST",
                    'state' => "TEST",
                    'country_code' => "TEST",
                    'postal_code' => "TEST",
                    'Manifest_id' => "TEST",
                    'num_pages' => 1,
                    'ship_date' => "2023-6-29"
                ]]
            );

        $repository = new ShipmentRepository($mockErpService);
        $result = $repository->getByUcc("TEST");
        
        $this->assertSame("TEST", $result->getCustomerNumber());
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
                'email' => "TEST",
                'opn' => 1,
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'Manifest_id' => "TEST",
                'num_pages' => 1,
                'ship_date' => "2023-6-29"
            ]]);

        $repository = new ShipmentRepository($mockErpService);
        $result = $repository->findOpen(1000, 0);
        $items = $result->getShipments();
        
        $this->assertSame("TEST", $items[0]->getCustomerNumber());
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
                'email' => "TEST",
                'opn' => 1,
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'Manifest_id' => "TEST",
                'num_pages' => 1,
                'ship_date' => "2023-6-29"
            ]]);

        $repository = new ShipmentRepository($mockErpService);
        $result = $repository->findOpen(1000, 0);
        $items = $result->getShipments();
        
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
                'email' => "TEST",
                'opn' => 1,
                'order' => "TEST",
                'ord_date' => "2023-6-29",
                'ord_ext' => "TEST",
                'phone' => "TEST",
                'rec_seq' => "TEST",
                'ship_via_code' => "TEST",
                'stat' => "TEST",
                'state' => "TEST",
                'country_code' => "TEST",
                'postal_code' => "TEST",
                'Manifest_id' => "TEST",
                'num_pages' => 1,
                'ship_date' => "2023-6-29"
            ]]);

        $repository = new ShipmentRepository($mockErpService);
        $result = $repository->get("TEST", 1);
        
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
                'q_ord' => 2,
                'q_comm' => 2                
            ]]);

        $repository = new ShipmentRepository($mockErpService);
        $result = $repository->getItems("TEST", 1);
        $items = $result->getItems();
        
        $this->assertSame("TEST", $items[0]->getItemNumber());
    }
    
    public function testGetPackages(): void
    {
        $mockErpService = $this->createMock(ErpService::class);
        $mockErpService->expects($this->any())
            ->method('read')
            ->willReturnOnConsecutiveCalls(
                [(object) [
                    'ed_ucc128ln_ucc' => "TEST",
                    'ed_ucc128ln_tracking_no' => "TEST"
                ]],
                [(object) [
                    'oe_ship_pack_ship_via_code' => "TEST",
                    'oe_ship_pack_pkg_chg' => 1,
                    'oe_ship_pack_pack_weight' => 2,
                    'oe_ship_pack_pack_height' => 3,
                    'oe_ship_pack_pack_length' => 4,
                    'oe_ship_pack_pack_width' => 5,
                    'oe_ship_pack_manifest_carrier' => "TEST"
                ]],
                [(object) [
                    'ed_ucc128pk_item' => "TEST",
                    'ed_ucc128pk_qty_shp' => 2
                ]],
            );

        $repository = new ShipmentRepository($mockErpService);
        $result = $repository->getPackages("TEST");
        $items = $result->getShipmentPackages();
        
        $this->assertSame("TEST", $items[0]->getUcc());
        $this->assertSame("TEST", $items[0]->getItems()[0]->getItemNumber());
    }
}
