<?php

namespace App\Repository\Erp;

use DateTime;
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
            $item->setResidential($erpItem->residential);
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
    public function findAll($limit = 100, $offset = 0, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '{$company}' "
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
    public function findOpen($limit = 100, $offset = 0, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '{$company}' "
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
    public function findByTextSearch($searchTerms, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '{$company}' "
                . "AND oe_head.rec_type = 'O' "
                . "AND oe_head.sy_lookup MATCHES '*{$searchTerms}*'";


        return $this->_find($query, 100);
    }

    /**
     * 
     * @param integer $orderNumber
     * @return SalesOrder
     */
    public function get($orderNumber, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '{$company}' "
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
            $item->setResidential($erpItem->residential);
        }

        return $item;
    }

    /**
     * 
     * @param string $webReferenceNumber
     * @param string $customerNumber
     * @return SalesOrder
     */
    public function getByWebReferenceNumberAndCustomerNumber($webReferenceNumber, $customerNumber, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '{$company}' "
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
            $item->setResidential($erpItem->residential);
        }

        return $item;
    }

    /**
     * 
     * @param integer $orderNumber
     * @return SalesOrderItemCollection
     */
    public function getItems($orderNumber, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $query = "FOR EACH oe_line NO-LOCK "
                . "WHERE oe_line.company_oe = '{$company}' "
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
     * @param SalesOrder $order
     * @param SalesOrderItemCollection $items
     * @return boolean
     */
    public function submitOrder(SalesOrder $order, SalesOrderItemCollection $items, $company = null, $warehouse = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        if ($warehouse == null) {
            $warehouse = $this->erp->getWarehouse();
        } else {
            if (array_search($warehouse, $this->erp->getAvailableWarehouses()) === false) {
                throw new \Exception("INVALID WAREHOUSE SELECTED");
            }
        }

        $data = array(
            'order_ext' => $order->getWebReferenceNumber(),
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
            'company_cu' => $company,
            'company_oe' => $company,
            'warehouse' => $warehouse,
            'ship_via_code' => $order->getShipViaCode(),
            'residential' => $order->isResidential()
        );

        $this->erp->create('ec_oehead', array($data), false);

        $itemData = array();

        foreach ($items as $key => $item) {

            $erpItem = $this->erp
                    ->getProductRepository()
                    ->getByItemNumber($item->getItemNumber());
            
            if ($erpItem) {
            
                $itemData[] = array(
                    'order_ext' => $order->getWebReferenceNumber(),
                    'customer' => $order->getCustomerNumber(),
                    'line' => empty($item->getLineNumber()) ? $key + 1 : $item->getLineNumber(),
                    'item' => $item->getItemNumber(),
                    'qty_ord' => $item->getQuantityOrdered(),
    //                'unit_price' => $erpItem->getWholesalePrice(),
                    'um_o' => $erpItem->getUnitOfMeasure(),
                    'company_cu' => $company,
                    'company_it' => $company,
                    'company_oe' => $company,
                    'warehouse' => $warehouse,
                    'override_price' => 'no',
                    'misc_log' => array('yes')
                );
            
            }
            
        }

        $this->erp->create('ec_oeline', $itemData, false);

        return true;
    }

    public function findByOrderDate(DateTime $startDate, DateTime $endDate, $limit = 100, $offset = 0, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $startDateString = $startDate->format('m/d/Y');
        $endDateString = $endDate->format('m/d/Y');

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '{$company}' "
                . "AND oe_head.rec_type = 'O' "
                . "AND oe_head.ord_date >= $startDateString "
                . "AND oe_head.ord_date <= $endDateString";
        
        return $this->_find($query, $limit, $offset);
    }

    public function findByCustomerNumberAndOrderDate($customerNumber, DateTime $startDate, DateTime $endDate, $limit = 100, $offset = 0, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $startDateString = $startDate->format('m/d/Y');
        $endDateString = $endDate->format('m/d/Y');

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '{$company}' "
                . "AND oe_head.customer = '{$customerNumber}' "
                . "AND oe_head.rec_type = 'O' "
                . "AND oe_head.ord_date >= $startDateString "
                . "AND oe_head.ord_date <= $endDateString";

        return $this->_find($query, $limit, $offset);
    }

}
