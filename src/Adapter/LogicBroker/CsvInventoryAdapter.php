<?php

namespace App\Adapter\LogicBroker;

use App\Model\LogicBroker\Inventory;

class CsvInventoryAdapter extends AbstractInventoryAdapter {

    public function writeHeader() {

        $header = [
            'SupplierSKU',
            'MerchantSKU',
            'UPC',
            'ManufacturerSKU',
            'Quantity',
            'Cost',
            'MSRP',
            'RetailPrice',
            'Description',
            'Size',
            'Color',
            'Style',
            'Weight',
            'Warehouse'
        ];

        $this->file->fputcsv($header);
    }

    /**
     * 
     * @param Inventory $inventory
     */
    public function writeLine(Inventory $inventory) {

        $row = [
            $inventory->getSupplierSKU(),
            $inventory->getMerchantSKU(),
            $inventory->getUpc(),
            $inventory->getManufacturerSKU(),
            $inventory->getQuantity(),
            $inventory->getCost(),
            $inventory->getMsrp(),
            $inventory->getRetailPrice(),
            $inventory->getDescription(),
            $inventory->getSize(),
            $inventory->getColor(),
            $inventory->getStyle(),
            $inventory->getWeight(),
            $inventory->getWarehouse()
        ];

        $this->file->fputcsv($row);
    }

}
