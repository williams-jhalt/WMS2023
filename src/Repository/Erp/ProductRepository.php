<?php

namespace App\Repository\Erp;

use DateTime;
use App\Model\Erp\Product;
use App\Model\Erp\ProductCollection;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface {

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * @return ProductCollection
     */
    public function findAll($limit = 1000, $offset = 0) {

        $query = "FOR EACH item NO-LOCK "
                . "WHERE item.company_it = '" . $this->erp->getCompany() . "', "
                . "EACH wa_item NO-LOCK WHERE "
                . "wa_item.company_it = item.company_it AND "
                . "wa_item.item = item.item";

        $fields = "item.item,"
                . "item.descr,"
                . "wa_item.ship_location,"
                . "wa_item.list_price,"
                . "wa_item.qty_cmtd,"
                . "wa_item.qty_oh,"
                . "wa_item.warehouse,"
                . "item.um_display,"
                . "item.original_release_date,"
                . "item.manufacturer,"
                . "item.product_line,"
                . "item.date_added,"
                . "item.web_item,"
                . "item.is_deleted,"
                . "item.upc1";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new Product();
            $item->setItemNumber($erpItem->item_item);
            $item->setName(join(" ", $erpItem->item_descr));
            $item->setBinLocation($erpItem->wa_item_ship_location);
            $item->setWholesalePrice($erpItem->wa_item_list_price);
            $item->setQuantityCommitted($erpItem->wa_item_qty_cmtd);
            $item->setQuantityOnHand($erpItem->wa_item_qty_oh);
            if (!empty($erpItem->item_original_release_date)) {
                $item->setReleaseDate(new DateTime($erpItem->item_original_release_date));
            } else {
                $item->setReleaseDate(new DateTime($erpItem->item_date_added));
            }
            $item->setManufacturerCode($erpItem->item_manufacturer);
            $item->setProductTypeCode($erpItem->item_product_line);
            $item->setCreatedOn(new DateTime($erpItem->item_date_added));
            $item->setDeleted($erpItem->item_is_deleted);
            $item->setWebItem($erpItem->item_web_item);
            $item->setWarehouse($erpItem->wa_item_warehouse);
            $item->setUnitOfMeasure($erpItem->item_um_display);
            $item->setBarcode($erpItem->item_upc1);
            $result[] = $item;
        }

        return new ProductCollection($result);
    }

    /**
     * 
     * @param string $searchTerms
     * @param integer $limit
     * @param integer $offset
     * @return ProductCollection
     */
    public function findByTextSearch($searchTerms, $limit = 1000, $offset = 0): ProductCollection {

        $query = "FOR EACH item NO-LOCK "
                . "WHERE item.company_it = '{$this->erp->getCompany()}' "
                . "AND item.sy_lookup MATCHES '*{$searchTerms}*', "
                . "EACH wa_item NO-LOCK WHERE "
                . "wa_item.company_it = item.company_it AND "
                . "wa_item.item = item.item";

        $fields = "item.item,"
                . "item.descr,"
                . "wa_item.ship_location,"
                . "wa_item.list_price,"
                . "wa_item.qty_cmtd,"
                . "wa_item.qty_oh,"
                . "wa_item.warehouse,"
                . "item.um_display,"
                . "item.original_release_date,"
                . "item.manufacturer,"
                . "item.product_line,"
                . "item.date_added,"
                . "item.web_item,"
                . "item.is_deleted,"
                . "item.upc1";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new Product();
            $item->setItemNumber($erpItem->item_item);
            $item->setName(join(" ", $erpItem->item_descr));
            $item->setBinLocation($erpItem->wa_item_ship_location);
            $item->setWholesalePrice($erpItem->wa_item_list_price);
            $item->setQuantityCommitted($erpItem->wa_item_qty_cmtd);
            $item->setQuantityOnHand($erpItem->wa_item_qty_oh);
            if (!empty($erpItem->item_original_release_date)) {
                $item->setReleaseDate(new DateTime($erpItem->item_original_release_date));
            } else {
                $item->setReleaseDate(new DateTime($erpItem->item_date_added));
            }
            $item->setManufacturerCode($erpItem->item_manufacturer);
            $item->setProductTypeCode($erpItem->item_product_line);
            $item->setCreatedOn(new DateTime($erpItem->item_date_added));
            $item->setDeleted($erpItem->item_is_deleted);
            $item->setWebItem($erpItem->item_web_item);
            $item->setWarehouse($erpItem->wa_item_warehouse);
            $item->setUnitOfMeasure($erpItem->item_um_display);
            $item->setBarcode($erpItem->item_upc1);
            $result[] = $item;
        }

        return new ProductCollection($result);
    }

    /**
     * 
     * @param string $itemNumber
     * @return Product
     */
    public function getByItemNumber($itemNumber) {

        $query = "FOR EACH item NO-LOCK "
                . "WHERE item.company_it = '{$this->erp->getCompany()}' "
                . "AND item.item EQ '{$itemNumber}', "
                . "EACH wa_item NO-LOCK WHERE "
                . "wa_item.company_it = item.company_it AND "
                . "wa_item.item = item.item";

        $fields = "item.item,"
                . "item.descr,"
                . "wa_item.ship_location,"
                . "wa_item.list_price,"
                . "wa_item.qty_cmtd,"
                . "wa_item.qty_oh,"
                . "wa_item.warehouse,"
                . "item.um_display,"
                . "item.original_release_date,"
                . "item.manufacturer,"
                . "item.product_line,"
                . "item.date_added,"
                . "item.web_item,"
                . "item.is_deleted,"
                . "item.upc1";

        $response = $this->erp->read($query, $fields, 1);

        if (sizeof($response) == 0) {
            return null;
        }

        $erpItem = $response[0];

        $item = new Product();
        $item->setItemNumber($erpItem->item_item);
        $item->setName(join(" ", $erpItem->item_descr));
        $item->setBinLocation($erpItem->wa_item_ship_location);
        $item->setWholesalePrice($erpItem->wa_item_list_price);
        $item->setQuantityCommitted($erpItem->wa_item_qty_cmtd);
        $item->setQuantityOnHand($erpItem->wa_item_qty_oh);
        if (!empty($erpItem->item_original_release_date)) {
            $item->setReleaseDate(new DateTime($erpItem->item_original_release_date));
        } else {
            $item->setReleaseDate(new DateTime($erpItem->item_date_added));
        }
        $item->setManufacturerCode($erpItem->item_manufacturer);
        $item->setProductTypeCode($erpItem->item_product_line);
        $item->setCreatedOn(new DateTime($erpItem->item_date_added));
        $item->setDeleted($erpItem->item_is_deleted);
        $item->setWebItem($erpItem->item_web_item);
        $item->setWarehouse($erpItem->wa_item_warehouse);
        $item->setUnitOfMeasure($erpItem->item_um_display);
        $item->setBarcode($erpItem->item_upc1);

        return $item;
    }

    /**
     * 
     * @param int $limit
     * @param int $offset
     * @return ProductCollection
     */
    public function findCommittedItems($limit = 1000, $offset = 0) {

        $query = "FOR EACH item NO-LOCK "
                . "WHERE item.company_it = '{$this->erp->getCompany()}', "
                . "EACH wa_item NO-LOCK WHERE "
                . "wa_item.company_it = item.company_it AND "
                . "wa_item.item = item.item AND "
                . "wa_item.qty_cmtd > 0";

        $fields = "item.item,"
                . "item.descr,"
                . "wa_item.ship_location,"
                . "wa_item.list_price,"
                . "wa_item.qty_cmtd,"
                . "wa_item.qty_oh,"
                . "wa_item.warehouse,"
                . "item.um_display,"
                . "item.original_release_date,"
                . "item.manufacturer,"
                . "item.product_line,"
                . "item.date_added,"
                . "item.web_item,"
                . "item.is_deleted,"
                . "item.upc1";


        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new Product();
            $item->setItemNumber($erpItem->item_item);
            $item->setName(join(" ", $erpItem->item_descr));
            $item->setBinLocation($erpItem->wa_item_ship_location);
            $item->setWholesalePrice($erpItem->wa_item_list_price);
            $item->setQuantityCommitted($erpItem->wa_item_qty_cmtd);
            $item->setQuantityOnHand($erpItem->wa_item_qty_oh);
            if (!empty($erpItem->item_original_release_date)) {
                $item->setReleaseDate(new DateTime($erpItem->item_original_release_date));
            } else {
                $item->setReleaseDate(new DateTime($erpItem->item_date_added));
            }
            $item->setManufacturerCode($erpItem->item_manufacturer);
            $item->setProductTypeCode($erpItem->item_product_line);
            $item->setCreatedOn(new DateTime($erpItem->item_date_added));
            $item->setDeleted($erpItem->item_is_deleted);
            $item->setWebItem($erpItem->item_web_item);
            $item->setWarehouse($erpItem->wa_item_warehouse);
            $item->setUnitOfMeasure($erpItem->item_um_display);
            $item->setBarcode($erpItem->item_upc1);
            $result[] = $item;
        }

        return new ProductCollection($result);
    }

}
