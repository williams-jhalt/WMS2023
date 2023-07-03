<?php

namespace App\Repository\Erp;

use DateTime;
use App\Model\Erp\Invoice;
use App\Model\Erp\InvoiceCollection;
use App\Model\Erp\InvoiceItem;
use App\Model\Erp\InvoiceItemCollection;

class InvoiceRepository extends AbstractRepository implements InvoiceRepositoryInterface {

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * @return InvoiceCollection
     */
    public function findAll($limit = 1000, $offset = 0) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'I'";

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
                . "postal_code";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new Invoice();
            $item->setShipToAddress1($erpItem->adr[0]);
            $item->setShipToAddress2($erpItem->adr[1]);
            $item->setShipToAddress3($erpItem->adr[2]);
            $item->setShipToCity($erpItem->adr[3]);
            $item->setCustomerNumber($erpItem->customer);
            $item->setCustomerPurchaseOrder($erpItem->cu_po);
            $item->setShippingAndHandling($erpItem->c_tot_code_amt[0]);
            $item->setFreightCharge($erpItem->c_tot_code_amt[1]);
            $item->setGrossInvoiceAmount($erpItem->c_tot_gross);
            $item->setNetInvoiceAmount($erpItem->c_tot_net_ar);
            $item->setShipToEmail($erpItem->email);
            $item->setInvoiceDate(new DateTime($erpItem->invc_date));
            $item->setInvoiceNumber($erpItem->invoice);
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
            $result[] = $item;
        }

        return new InvoiceCollection($result);
    }

    /**
     * 
     * @param string $customerNumber
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param boolean $consolidated
     * @param integer $limit
     * @param integer $offset
     * @return InvoiceCollection
     */
    public function findByCustomerAndDate(string $customerNumber, DateTime $startDate = null, DateTime $endDate = null, bool $consolidated = false, int $limit = 1000, int $offset = 0) {


        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'I' AND "
                . "oe_head.customer = '{$customerNumber}'";

        if ($startDate !== null) {
            $startDateStr = $startDate->format("m/d/Y");
            $query .= " AND oe_head.invc_date >= '{$startDateStr}'";
        }

        if ($endDate !== null) {
            $endDateStr = $endDate->format("m/d/Y");
            $query .= " AND oe_head.invc_date <= '{$endDateStr}'";
        }

        if ($consolidated) {
            $query .= " AND oe_head.consolidated_order = yes";
        } else {
            $query .= " AND oe_head.consolidated_order = no AND oe_head.order > 0";
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
                . "postal_code";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new Invoice();
            $item->setShipToAddress1($erpItem->adr[0]);
            $item->setShipToAddress2($erpItem->adr[1]);
            $item->setShipToAddress3($erpItem->adr[2]);
            $item->setShipToCity($erpItem->adr[3]);
            $item->setCustomerNumber($erpItem->customer);
            $item->setCustomerPurchaseOrder($erpItem->cu_po);
            $item->setShippingAndHandling($erpItem->c_tot_code_amt[1]);
            $item->setFreightCharge($erpItem->c_tot_code_amt[0]);
            $item->setGrossInvoiceAmount($erpItem->c_tot_gross);
            $item->setNetInvoiceAmount($erpItem->c_tot_net_ar);
            $item->setShipToEmail($erpItem->email);
            $item->setInvoiceDate(new DateTime($erpItem->invc_date));
            $item->setInvoiceNumber($erpItem->invoice);
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
            $result[] = $item;
        }

        return new InvoiceCollection($result);
    }

    /**
     * 
     * @param integer $orderNumber
     * @return InvoiceCollection
     */
    public function findByOrderNumber($orderNumber) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'I' "
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
                . "postal_code";

        $response = $this->erp->read($query, $fields);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new Invoice();
            $item->setShipToAddress1($erpItem->adr[0]);
            $item->setShipToAddress2($erpItem->adr[1]);
            $item->setShipToAddress3($erpItem->adr[2]);
            $item->setShipToCity($erpItem->adr[3]);
            $item->setCustomerNumber($erpItem->customer);
            $item->setCustomerPurchaseOrder($erpItem->cu_po);
            $item->setShippingAndHandling($erpItem->c_tot_code_amt[0]);
            $item->setFreightCharge($erpItem->c_tot_code_amt[1]);
            $item->setGrossInvoiceAmount($erpItem->c_tot_gross);
            $item->setNetInvoiceAmount($erpItem->c_tot_net_ar);
            $item->setShipToEmail($erpItem->email);
            $item->setInvoiceDate(new DateTime($erpItem->invc_date));
            $item->setInvoiceNumber($erpItem->invoice);
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
            $result[] = $item;
        }

        return new InvoiceCollection($result);
    }

    /**
     * 
     * @param integer $orderNumber
     * @param integer $recordSequence
     * @return Invoice
     */
    public function get($orderNumber, $recordSequence = 1) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.rec_type = 'I' "
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
                . "postal_code";

        $response = $this->erp->read($query, $fields, 1);

        $erpItem = $response[0];

        $item = new Invoice();
        $item->setShipToAddress1($erpItem->adr[0]);
        $item->setShipToAddress2($erpItem->adr[1]);
        $item->setShipToAddress3($erpItem->adr[2]);
        $item->setShipToCity($erpItem->adr[3]);
        $item->setCustomerNumber($erpItem->customer);
        $item->setCustomerPurchaseOrder($erpItem->cu_po);
        $item->setShippingAndHandling($erpItem->c_tot_code_amt[0]);
        $item->setFreightCharge($erpItem->c_tot_code_amt[1]);
        $item->setGrossInvoiceAmount($erpItem->c_tot_gross);
        $item->setNetInvoiceAmount($erpItem->c_tot_net_ar);
        $item->setShipToEmail($erpItem->email);
        $item->setInvoiceDate(new DateTime($erpItem->invc_date));
        $item->setInvoiceNumber($erpItem->invoice);
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

        return $item;
    }

    /**
     * 
     * @param integer $orderNumber
     * @param integer $recordSequence
     * @return InvoiceItemCollection
     */
    public function getItems($orderNumber, $recordSequence = 1) {

        $query = "FOR EACH oe_line NO-LOCK "
                . "WHERE oe_line.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_line.rec_type = 'I' "
                . "AND oe_line.order = '{$orderNumber}' AND oe_line.rec_seq = '{$recordSequence}'";

        $fields = "line,item,descr,price,q_ord,q_itd,q_comm,um_o";

        $response = $this->erp->read($query, $fields);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new InvoiceItem();
            $item->setLineNumber($erpItem->line);
            $item->setItemNumber($erpItem->item);
            $item->setQuantityBilled($erpItem->q_itd);
            $item->setQuantityOrdered($erpItem->q_ord);
            $item->setPrice($erpItem->price);
            $item->setUnitOfMeasure($erpItem->um_o);
            $result[] = $item;
        }

        return new InvoiceItemCollection($result);
    }

}
