<?php

namespace App\Repository\Erp;

use DateTime;
use App\Model\Erp\Shipment;
use App\Model\Erp\ShipmentCollection;
use App\Model\Erp\ShipmentItem;
use App\Model\Erp\ShipmentItemCollection;
use App\Model\Erp\ShipmentPackage;
use App\Model\Erp\ShipmentPackageCollection;
use App\Model\Erp\ShipmentPackageItem;
use Exception;

class ShipmentRepository extends AbstractRepository implements ShipmentRepositoryInterface {

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * @return ShipmentCollection
     */
    public function findAll($limit = 1000, $offset = 0) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'S'";

        $fields = "adr,"
                . "created_date,"
                . "created_time,"
                . "customer,"
                . "cu_po,"
                . "c_tot_code,"
                . "c_tot_code_amt,"
                . "c_tot_gross,"
                . "c_tot_net_ar,"
                . "email,"
                . "invc_date,"
                . "invc_seq,"
                . "invoice,"
                . "opn,"
                . "order,"
                . "ord_date,"
                . "ord_ext,"
                . "phone,"
                . "rec_seq,"
                . "residential,"
                . "ship_via_code,"
                . "stat,"
                . "state,"
                . "country_code,"
                . "postal_code,"
                . "Manifest_id,"
                . "num_pages,"
                . "ship_date";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $result[] = $this->_loadShipmentFromErp($erpItem);
        }

        return new ShipmentCollection($result);
    }

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * @return ShipmentCollection
     */
    public function findOpen($limit = 1000, $offset = 0) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'S' "
                . "AND oe_head.opn = yes";

        $fields = "adr,"
                . "created_date,"
                . "created_time,"
                . "customer,"
                . "cu_po,"
                . "c_tot_code,"
                . "c_tot_code_amt,"
                . "c_tot_gross,"
                . "c_tot_net_ar,"
                . "email,"
                . "invc_date,"
                . "invc_seq,"
                . "invoice,"
                . "opn,"
                . "order,"
                . "ord_date,"
                . "ord_ext,"
                . "phone,"
                . "rec_seq,"
                . "residential,"
                . "ship_via_code,"
                . "stat,"
                . "state,"
                . "country_code,"
                . "postal_code,"
                . "Manifest_id,"
                . "num_pages,"
                . "ship_date";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $result[] = $this->_loadShipmentFromErp($erpItem);
        }

        return new ShipmentCollection($result);
    }

    /**
     * 
     * @param integer $orderNumber
     * @return ShipmentCollection
     */
    public function findByOrderNumber($orderNumber) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'S' "
                . "AND oe_head.order = '{$orderNumber}'";

        $fields = "adr,"
                . "created_date,"
                . "created_time,"
                . "customer,"
                . "cu_po,"
                . "c_tot_code,"
                . "c_tot_code_amt,"
                . "c_tot_gross,"
                . "c_tot_net_ar,"
                . "email,"
                . "invc_date,"
                . "invc_seq,"
                . "invoice,"
                . "opn,"
                . "order,"
                . "ord_date,"
                . "ord_ext,"
                . "phone,"
                . "rec_seq,"
                . "residential,"
                . "ship_via_code,"
                . "stat,"
                . "state,"
                . "country_code,"
                . "postal_code,"
                . "Manifest_id,"
                . "num_pages,"
                . "ship_date";

        $response = $this->erp->read($query, $fields);

        $result = array();

        foreach ($response as $erpItem) {
            $result[] = $this->_loadShipmentFromErp($erpItem);
        }

        return new ShipmentCollection($result);
    }

    /**
     * 
     * @param integer $orderNumber
     * @param integer $recordSequence
     * @return Shipment
     */
    public function get($orderNumber, $recordSequence = 1) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'S' "
                . "AND oe_head.order = '{$orderNumber}' AND oe_head.rec_seq = '{$recordSequence}'";

        $fields = "adr,"
                . "created_date,"
                . "created_time,"
                . "customer,"
                . "cu_po,"
                . "c_tot_code,"
                . "c_tot_code_amt,"
                . "c_tot_gross,"
                . "c_tot_net_ar,"
                . "email,"
                . "invc_date,"
                . "invc_seq,"
                . "invoice,"
                . "opn,"
                . "order,"
                . "ord_date,"
                . "ord_ext,"
                . "phone,"
                . "rec_seq,"
                . "residential,"
                . "ship_via_code,"
                . "stat,"
                . "state,"
                . "country_code,"
                . "postal_code,"
                . "Manifest_id,"
                . "num_pages,"
                . "ship_date";

        $response = $this->erp->read($query, $fields, 1);

        if (count($response) > 0) {

            $erpItem = $response[0];

            return $result[] = $this->_loadShipmentFromErp($erpItem);
        }

        return new Shipment();
    }

    /**
     * 
     * @param integer $orderNumber
     * @param integer $recordSequence
     * @return ShipmentItemCollection
     */
    public function getItems($orderNumber, $recordSequence = 1) {

        $query = "FOR EACH oe_line NO-LOCK "
                . "WHERE oe_line.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_line.rec_type = 'S' "
                . "AND oe_line.order = '{$orderNumber}' AND oe_line.rec_seq = '{$recordSequence}'";

        $fields = "line,"
                . "item,"
                . "descr,"
                . "price,"
                . "q_ord,"
                . "q_comm";

        $response = $this->erp->read($query, $fields);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new ShipmentItem();
            $item->setLineNumber($erpItem->line);
            $item->setItemNumber($erpItem->item);
            $item->setQuantityOrdered($erpItem->q_ord);
            $item->setQuantityShipped($erpItem->q_comm);
            $result[] = $item;
        }

        return new ShipmentItemCollection($result);
    }

    /**
     * 
     * @param integer $orderNumber
     * @return ShipmentPackageCollection
     */
    public function getPackages($orderNumber) {

        $query = "FOR EACH ed_ucc128ln NO-LOCK WHERE "
                . "ed_ucc128ln.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND ed_ucc128ln.order = '{$orderNumber}'";

        $fields = "ed_ucc128ln.ucc,ed_ucc128ln.tracking_no";

        $response = $this->erp->read($query, $fields);

        $result = array();

        foreach ($response as $uccln) {

            $package = new ShipmentPackage();
            $package->setUcc($uccln->ed_ucc128ln_ucc);
            $package->setTrackingNumber($uccln->ed_ucc128ln_tracking_no);

            if ($package->getTrackingNumber() !== null) {
                $query2 = "FOR EACH oe_ship_pack NO-LOCK WHERE "
                        . "oe_ship_pack.company_oe = '" . $this->erp->getCompany() . "' "
                        . "AND oe_ship_pack.order = '{$orderNumber}' "
                        . "AND oe_ship_pack.tracking_no = '" . $package->getTrackingNumber() . "'";

                $fields2 = "oe_ship_pack.ship_via_code,"
                        . "oe_ship_pack.pkg_chg,"
                        . "oe_ship_pack.pack_weight,"
                        . "oe_ship_pack.pack_height,"
                        . "oe_ship_pack.pack_length,"
                        . "oe_ship_pack.pack_width,"
                        . "oe_ship_pack.manifest_carrier";

                $result2 = $this->erp->read($query2, $fields2);

                if (count($result2) > 0) {
                    $package->setShipViaCode($result2[0]->oe_ship_pack_ship_via_code);
                    $package->setFreightCost($result2[0]->oe_ship_pack_pkg_chg);
                    $package->setShippingWeight($result2[0]->oe_ship_pack_pack_weight);
                    $package->setPackageHeight($result2[0]->oe_ship_pack_pack_height);
                    $package->setPackageLength($result2[0]->oe_ship_pack_pack_length);
                    $package->setPackageWidth($result2[0]->oe_ship_pack_pack_width);
                    $package->setManifestCarrier($result2[0]->oe_ship_pack_manifest_carrier);
                }
            }

            $query3 = "FOR EACH ed_ucc128pk NO-LOCK WHERE "
                    . "ed_ucc128pk.company_oe = '" . $this->erp->getCompany() . "' "
                    . "AND ed_ucc128pk.order = '" . $orderNumber . "' "
                    . "AND ed_ucc128pk.ucc = '" . $package->getUcc() . "'";

            $fields3 = "ed_ucc128pk.item,ed_ucc128pk.qty_shp";

            $result3 = $this->erp->read($query3, $fields3);

            $items = array();

            foreach ($result3 as $uccpk) {

                $item2 = new ShipmentPackageItem();
                $item2->setItemNumber($uccpk->ed_ucc128pk_item);
                $item2->setQuantity($uccpk->ed_ucc128pk_qty_shp);

                $items[] = $item2;
            }

            $package->setItems($items);
            $result[] = $package;
        }

        return new ShipmentPackageCollection($result);
    }

    /**
     * 
     * @param stdClass $erpShipment
     * @return Shipment
     * 
     */
    private function _loadShipmentFromErp($erpShipment) {

        $shipment = new Shipment();

        $shipment->setShipToAddress1($erpShipment->adr[0]);
        $shipment->setShipToAddress2($erpShipment->adr[1]);
        $shipment->setShipToAddress3($erpShipment->adr[2]);
        $shipment->setShipToCity($erpShipment->adr[3]);
        $shipment->setCustomerNumber($erpShipment->customer);
        $shipment->setCustomerPurchaseOrder($erpShipment->cu_po);
        $shipment->setShipToEmail($erpShipment->email);
        $shipment->setOpen($erpShipment->opn);
        $shipment->setOrderNumber($erpShipment->order);
        $shipment->setOrderDate(new DateTime($erpShipment->ord_date));
        $shipment->setWebReferenceNumber($erpShipment->ord_ext);
        $shipment->setShipToPhone($erpShipment->phone);
        $shipment->setRecordSequence($erpShipment->rec_seq);
        $shipment->setShipViaCode($erpShipment->ship_via_code);
        $shipment->setStatus($erpShipment->stat);
        $shipment->setShipToState($erpShipment->state);
        $shipment->setShipToCountry($erpShipment->country_code);
        $shipment->setShipToZip($erpShipment->postal_code);
        $shipment->setManifestId($erpShipment->Manifest_id);
        $shipment->setNumberOfPages($erpShipment->num_pages);
        $shipment->setShipDate($erpShipment->ship_date);

        return $shipment;
    }

    /**
     * 
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param int $limit
     * @param int $offset
     */
    public function findByShippingDate(DateTime $startDate, DateTime $endDate, $limit = 1000, $offset = 0) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' ";
        
        if ($startDate !== null) {
            $startDateStr = $startDate->format("m/d/Y");
            $query .= " AND oe_head.ship_date >= '{$startDateStr}'";
        }

        if ($endDate !== null) {
            $endDateStr = $endDate->format("m/d/Y");
            $query .= " AND oe_head.ship_date <= '{$endDateStr}'";
        }

        $fields = "adr,"
                . "created_date,"
                . "created_time,"
                . "customer,"
                . "cu_po,"
                . "c_tot_code,"
                . "c_tot_code_amt,"
                . "c_tot_gross,"
                . "c_tot_net_ar,"
                . "email,"
                . "invc_date,"
                . "invc_seq,"
                . "invoice,"
                . "opn,"
                . "order,"
                . "ord_date,"
                . "ord_ext,"
                . "phone,"
                . "rec_seq,"
                . "residential,"
                . "ship_via_code,"
                . "stat,"
                . "state,"
                . "country_code,"
                . "postal_code,"
                . "Manifest_id,"
                . "num_pages,"
                . "ship_date";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $result[] = $this->_loadShipmentFromErp($erpItem);
        }

        return new ShipmentCollection($result);
    }
    
    public function getByUcc($ucc) {
        
        $query = "FOR EACH ed_ucc128ln NO-LOCK WHERE "
                . "ed_ucc128ln.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND ed_ucc128ln.ucc = '{$ucc}'";

        $fields = "order";

        $response = $this->erp->read($query, $fields);
        
        if (sizeof($response) < 0) {
            throw new Exception("Package not found");
        }
        
        $orderNumber = $response[0]->order;
        
        return $this->get($orderNumber);
        
    }
    
    public function submitShipmentPackage($shipmentPackage) {
        ;
    }

}
