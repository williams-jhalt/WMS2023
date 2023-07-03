<?php

namespace App\Repository\Erp;

use DateTime;
use App\Model\Erp\Order;
use App\Model\Erp\SalesOrder;
use App\Model\Erp\SalesOrderCollection;
use App\Model\Erp\SalesOrderItem;
use App\Model\Erp\SalesOrderItemCollection;

class SalesOrderRepository extends AbstractRepository implements SalesOrderRepositoryInterface {

    /**
     * 
     * @param string $query
     * @param integer $limit
     * @param integer $offset
     * @return SalesOrderCollection
     */
    private function _find($query, $limit = 100, $offset = 0) {

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
                . "source_code";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new SalesOrder();
            $item->setShipToAddress1($erpItem->adr[0]);
            $item->setShipToAddress2($erpItem->adr[1]);
            $item->setShipToAddress3($erpItem->adr[2]);
            $item->setShipToCity($erpItem->adr[3]);
            $item->setCustomerNumber($erpItem->customer);
            $item->setCustomerPurchaseOrder($erpItem->cu_po);
            $item->setShipToEmail($erpItem->email);
            $item->setOpen($erpItem->opn);
            $item->setOrderNumber($erpItem->order);
            $item->setOrderDate(new DateTime($erpItem->ord_date));
            $item->setWebReferenceNumber($erpItem->ord_ext);
            $item->setShipToPhone($erpItem->phone);
            $item->setRecordSequence($erpItem->rec_seq);
            $item->setShipViaCode($erpItem->ship_via_code);
            $item->setStatus($erpItem->stat);
            $item->setShipToState($erpItem->state);
            $item->setShipToCountry($erpItem->country_code);
            $item->setShipToZip($erpItem->postal_code);
            $item->setSourceCode($erpItem->source_code);
            $result[] = $item;
        }

        return new SalesOrderCollection($result);
    }

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * @return SalesOrderCollection
     */
    public function findAll($limit = 100, $offset = 0) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'O' "
                . "USE-INDEX order";

        return $this->_find($query, $limit, $offset);
    }

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * @return SalesOrderCollection
     */
    public function findOpen($limit = 100, $offset = 0) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'O' "
                . "AND oe_head.opn = 'Y' "
                . "USE-INDEX order";

        return $this->_find($query, $limit, $offset);
    }

    /**
     * 
     * @param string $searchTerms
     * @return SalesOrderCollection
     */
    public function findByTextSearch($searchTerms) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'O' "
                . "AND oe_head.sy_lookup MATCHES '*{$searchTerms}*'";


        return $this->_find($query, 100);
    }

    /**
     * 
     * @param integer $orderNumber
     * @return SalesOrder
     */
    public function get($orderNumber) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'O' "
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
                . "source_code";

        $response = $this->erp->read($query, $fields, 1);

        $item = new SalesOrder();

        if (count($response) > 0) {
            $erpItem = $response[0];
            $item->setShipToAddress1($erpItem->adr[0]);
            $item->setShipToAddress2($erpItem->adr[1]);
            $item->setShipToAddress3($erpItem->adr[2]);
            $item->setShipToCity($erpItem->adr[3]);
            $item->setCustomerNumber($erpItem->customer);
            $item->setCustomerPurchaseOrder($erpItem->cu_po);
            $item->setShipToEmail($erpItem->email);
            $item->setOpen($erpItem->opn);
            $item->setOrderNumber($erpItem->order);
            $item->setOrderDate(new DateTime($erpItem->ord_date));
            $item->setWebReferenceNumber($erpItem->ord_ext);
            $item->setShipToPhone($erpItem->phone);
            $item->setRecordSequence($erpItem->rec_seq);
            $item->setShipViaCode($erpItem->ship_via_code);
            $item->setStatus($erpItem->stat);
            $item->setShipToState($erpItem->state);
            $item->setShipToCountry($erpItem->country_code);
            $item->setShipToZip($erpItem->postal_code);
            $item->setSourceCode($erpItem->source_code);
        }

        return $item;
    }

    /**
     * 
     * @param string $webReferenceNumber
     * @param string $customerNumber
     * @return SalesOrder
     */
    public function getByWebReferenceNumberAndCustomerNumber($webReferenceNumber, $customerNumber) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'O' "
                . "AND oe_head.ord_ext = '{$webReferenceNumber}' "
                . "AND oe_head.customer = '{$customerNumber}'";
                
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
                . "source_code";

        $response = $this->erp->read($query, $fields, 1);

        $item = new SalesOrder();

        if (count($response) > 0) {
            $erpItem = $response[0];
            $item->setShipToAddress1($erpItem->adr[0]);
            $item->setShipToAddress2($erpItem->adr[1]);
            $item->setShipToAddress3($erpItem->adr[2]);
            $item->setShipToCity($erpItem->adr[3]);
            $item->setCustomerNumber($erpItem->customer);
            $item->setCustomerPurchaseOrder($erpItem->cu_po);
            $item->setShipToEmail($erpItem->email);
            $item->setOpen($erpItem->opn);
            $item->setOrderNumber($erpItem->order);
            $item->setOrderDate(new DateTime($erpItem->ord_date));
            $item->setWebReferenceNumber($erpItem->ord_ext);
            $item->setShipToPhone($erpItem->phone);
            $item->setRecordSequence($erpItem->rec_seq);
            $item->setShipViaCode($erpItem->ship_via_code);
            $item->setStatus($erpItem->stat);
            $item->setShipToState($erpItem->state);
            $item->setShipToCountry($erpItem->country_code);
            $item->setShipToZip($erpItem->postal_code);
            $item->setSourceCode($erpItem->source_code);
        }

        return $item;
    }

    /**
     * 
     * @param integer $orderNumber
     * @return SalesOrderItemCollection
     */
    public function getItems($orderNumber) {

        $query = "FOR EACH oe_line NO-LOCK "
                . "WHERE oe_line.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_line.rec_type = 'O' "
                . "AND oe_line.order = '{$orderNumber}'";

        $fields = "line,"
                . "item,"
                . "descr,"
                . "price,"
                . "q_ord";

        $response = $this->erp->read($query, $fields);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new SalesOrderItem();
            $item->setLineNumber($erpItem->line);
            $item->setItemNumber($erpItem->item);
            $item->setQuantityOrdered($erpItem->q_ord);
            $result[] = $item;
        }

        return new SalesOrderItemCollection($result);
    }

    /**
     * 
     * @param Order $order
     * @return boolean
     */
    public function submitOrder(Order $order) {

        $data = array(
            'order_ext' => $order->getWebOrderNumber(),
            'cu_po' => $order->getCustomerPurchaseOrder(),
            'customer' => $order->getCustomerNumber(),
            's_name' => $order->getShipToName(),
            's_adr' => array(
                $order->getShipToAddress1(),
                $order->getShipToAddress2(),
                $order->getShipToAddress3(),
                $order->getShipToCity()
            ),
            's_st' => $order->getShipToState(),
            's_postal_code' => $order->getShipToZip(),
            's_country_code' => $order->getShipToCountry(),
            'company_cu' => $this->erp->getCompany(),
            'company_oe' => $this->erp->getCompany(),
            'warehouse' => $this->erp->getWarehouse(),
            'ship_via_code' => $order->getShipViaCode(),
            'residential' => $order->getResidential()
        );

        $this->erp->create('ec_oehead', array($data), false);

        $itemData = array();

        foreach ($order->getItems() as $key => $item) {

            $erpItem = $this->erp
                    ->getProductRepository()
                    ->getByItemNumber($item->getItemNumber());
            
            if ($erpItem) {
            
                $itemData[] = array(
                    'order_ext' => $order->getWebOrderNumber(),
                    'customer' => $order->getCustomerNumber(),
                    'line' => empty($item->getLineNumber()) ? $key + 1 : $item->getLineNumber(),
                    'item' => $item->getItemNumber(),
                    'qty_ord' => $item->getQuantityOrdered(),
    //                'unit_price' => $erpItem->getWholesalePrice(),
                    'um_o' => $erpItem->getUnitOfMeasure(),
                    'company_cu' => $this->erp->getCompany(),
                    'company_it' => $this->erp->getCompany(),
                    'company_oe' => $this->erp->getCompany(),
                    'warehouse' => $this->erp->getWarehouse(),
                    'override_price' => 'no',
                    'misc_log' => array('yes')
                );
            
            }
            
        }

        $this->erp->create('ec_oeline', $itemData, false);

        return true;
    }

    public function findByOrderDate(DateTime $startDate, DateTime $endDate, $limit = 100, $offset = 0) {

        $startDateString = $startDate->format('m/d/Y');
        $endDateString = $endDate->format('m/d/Y');

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'O' "
                . "AND oe_head.ord_date >= $startDateString "
                . "AND oe_head.ord_date <= $endDateString";
        
        return $this->_find($query, $limit, $offset);
    }

    public function findByCustomerNumberAndOrderDate($customerNumber, DateTime $startDate, DateTime $endDate, $limit = 100, $offset = 0) {

        $startDateString = $startDate->format('m/d/Y');
        $endDateString = $endDate->format('m/d/Y');

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.customer = '{$customerNumber}' "
                . "AND oe_head.rec_type = 'O' "
                . "AND oe_head.ord_date >= $startDateString "
                . "AND oe_head.ord_date <= $endDateString";

        return $this->_find($query, $limit, $offset);
    }

}
