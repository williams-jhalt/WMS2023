<?php

namespace App\Service;

use App\Repository\Erp\CustomerRepository;
use App\Repository\Erp\InvoiceRepository;
use App\Repository\Erp\PackerLogEntryRepository;
use App\Repository\Erp\ProductRepository;
use App\Repository\Erp\SalesOrderRepository;
use App\Repository\Erp\ShipmentRepository;
use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class ErpService {

    private $_grantTokenId;
    private $_accessTokenId;

    public function __construct(private ContainerBagInterface $params, private CacheInterface $cache) {

        $this->_grantTokenId = md5("grant_token:{$this->params->get('app.erp.server')}:{$this->params->get('app.erp.company')}:{$this->params->get('app.erp.appname')}");
        $this->_accessTokenId = md5("access_token:{$this->params->get('app.erp.server')}:{$this->params->get('app.erp.company')}:{$this->params->get('app.erp.appname')}");

    }

    public function getAvailableCompanies() {
        return $this->params->get('app.erp.available_companies');
    }

    public function getAvailableWarehouses() {
        return $this->params->get('app.erp.available_warehouses');
    }

    /**
     * Retrieves API token from ERP
     * 
     * @param resource $ch
     * @throws ErpServiceException
     */
    private function _getGrantToken($ch = null) {

        return $this->cache->get($this->_grantTokenId, function(ItemInterface $item) use ($ch): string {
            $item->expiresAfter(3600);

            $closeCurlWhenFinished = false;

            if ($ch === null) {
                $ch = curl_init();
                $closeCurlWhenFinished = true;
            }

            curl_setopt($ch, CURLOPT_URL, $this->params->get('app.erp.server') . "/distone/rest/service/authorize/grant");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                'client' => $this->params->get('app.erp.appname'),
                'company' => $this->params->get('app.erp.company'),
                'username' => $this->params->get('app.erp.username'),
                'password' => $this->params->get('app.erp.password')
            )));

            $response = json_decode(curl_exec($ch));

            if (isset($response->_errors)) {
                $this->cache->delete($this->_accessTokenId);
                $this->cache->delete($this->_grantTokenId);
                throw new ErpServiceException($response->_errors[0]->_errorMsg, $response->_errors[0]->_errorNum); // find out the structure of ERP-ONE's errors
            }

            if ($closeCurlWhenFinished) {
                curl_close($ch);
            }

            return $response->grant_token;

        });
    }

    /**
     * Refreshes API token from ERP if expired
     * 
     * Returns the access token
     * 
     * @param resource $ch
     * @return string
     */
    private function _getAccessToken($ch = null): string {

        return $this->cache->get($this->_accessTokenId, function(ItemInterface $item) use ($ch): string {
            $item->expiresAfter(3600);

            $closeCurlWhenFinished = false;
    
            if ($ch === null) {
                $ch = curl_init();
                $closeCurlWhenFinished = true;
            }
    
            curl_setopt($ch, CURLOPT_URL, $this->params->get('app.erp.server') . "/distone/rest/service/authorize/access");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                'client' => $this->params->get('app.erp.appname'),
                'company' => $this->params->get('app.erp.company'),
                'grant_token' => $this->_getGrantToken()
            )));
    
            $response = json_decode(curl_exec($ch));
    
            if (isset($response->_errors)) {
                $this->cache->delete($this->_accessTokenId);
                $this->cache->delete($this->_grantTokenId);
                throw new ErpServiceException($response->_errors[0]->_errorMsg, $response->_errors[0]->_errorNum); // find out the structure of ERP-ONE's errors
            }
    
            if ($closeCurlWhenFinished) {
                curl_close($ch);
            }
    
            return $response->access_token;

        });
    }

    /**
     * 
     * @param string $table
     * @param array $records
     * @param boolean $triggers
     * @param resource $ch
     * @return mixed
     * @throws ErpServiceException
     */
    public function create(string $table, array $records, bool $triggers = true, $ch = null) {

        $closeCurlWhenFinished = false;

        if ($ch === null) {
            $ch = curl_init();
            $closeCurlWhenFinished = true;
        }

        curl_setopt($ch, CURLOPT_URL, $this->params->get('app.erp.server') . "/distone/rest/service/data/create");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $this->_getAccessToken()
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        $request = json_encode(array(
            'table' => $table,
            'records' => $records,
            'triggers' => $triggers
        ));

        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

        $t = curl_exec($ch);

        $response = json_decode($t);

        if ($closeCurlWhenFinished) {
            curl_close($ch);
        }

        if (isset($response->_errors)) {
            throw new ErpServiceException($response->_errors[0]->_errorMsg, $response->_errors[0]->_errorNum); // find out the structure of ERP-ONE's errors
        }

        return $response;
    }

    /**
     * 
     * @param string $query
     * @param string $columns
     * @param integer $limit
     * @param integer $offset
     * @param resource $ch
     * @return mixed
     * @throws ErpServiceException
     */
    public function read($query, $columns = "*", $limit = 0, $offset = 0, $ch = null) {

        $closeCurlWhenFinished = false;


        if ($ch === null) {
            $ch = curl_init();
            $closeCurlWhenFinished = true;
        }

        curl_setopt($ch, CURLOPT_URL, $this->params->get('app.erp.server') . "/distone/rest/service/data/read");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: ' . $this->_getAccessToken()
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            'query' => $query,
            'columns' => $columns,
            'skip' => $offset,
            'take' => $limit
        )));

        $response = json_decode(curl_exec($ch));

        if ($closeCurlWhenFinished) {
            curl_close($ch);
        }

        if (isset($response->_errors)) {
            throw new ErpServiceException($response->_errors[0]->_errorMsg, $response->_errors[0]->_errorNum); // find out the structure of ERP-ONE's errors
        }

        return $response;
    }

    /**
     * Gets item pricing based on customer, quantity, and unit of measure
     * 
     * Returns a object containing the following:
     * 
     * item - Item Number of the item that the price was calculated for.
     * warehouse - Warehouse Code used in the price calculation.
     * customer - Customer Id used to calculate customer based pricing.
     * cu_group - Customer Group code used in the price calculation.
     * vendor - Vendor Id used in the price calculation.
     * quantity - Quantity used to get the price at a specific quantity break level.
     * price - The calculated price of the item.
     * unit - Unit of measure code (price per).
     * origin - Price calculation origin code. This code indicates how the price was calculated internally.
     * commission - A sales commission percentage for the item.
     * column - Column price label when a column price was used in the calculation.
     * 
     * @param string $itemNumber
     * @param string $customer
     * @param integer $quantity
     * @param string $uom
     * @return mixed
     */
    public function getItemPriceDetails($itemNumber, $customer = null, $quantity = 1, $uom = "EA", $ch = null) {
        $closeCurlWhenFinished = false;

        if ($ch === null) {
            $ch = curl_init();
            $closeCurlWhenFinished = true;
        }

        $queryData = array();

        $queryData['item'] = $itemNumber;

        if ($customer !== null) {
            $queryData['customer'] = $customer;
        }

        $queryData['quantity'] = $quantity;
        $queryData['unit'] = $uom;

        $query = http_build_query($queryData);

        curl_setopt($ch, CURLOPT_URL, $this->params->get('app.erp.server') . "/distone/rest/service/price/fetch?" . $query);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . $this->_getAccessToken()
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = json_decode(curl_exec($ch));

        if ($closeCurlWhenFinished) {
            curl_close($ch);
        }

        if (isset($response->_errors)) {
            throw new ErpServiceException($response->_errors[0]->_errorMsg, $response->_errors[0]->_errorNum); // find out the structure of ERP-ONE's errors
        }

        return $response;
    }

    /**
     * Type can be: invoice, pick, pack, order
     * Record is the record number
     * Sequence defaults to 1
     * 
     * Returns the following array:
     * 
     * type: type of document
     * record: record number
     * seq: record sequence
     * encoding: MIME type
     * document: encoded document
     * 
     * @param string $type
     * @param string $record
     * @param string|null $seq
     */
    public function getPdf($type, $record, $seq = 1, $ch = null) {
        $closeCurlWhenFinished = false;

        if ($ch === null) {
            $ch = curl_init();
            $closeCurlWhenFinished = true;
        }

        $queryData = array(
            'type' => $type,
            'record' => $record,
            'seq' => $seq
        );

        $query = http_build_query($queryData);

        curl_setopt($ch, CURLOPT_URL, $this->params->get('app.erp.server') . "/distone/rest/service/form/fetch?" . $query);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . $this->_getAccessToken()
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $r = curl_exec($ch);

        $response = json_decode($r);

        if ($closeCurlWhenFinished) {
            curl_close($ch);
        }

        if (isset($response->_errors)) {
            throw new Exception($response->_errors[0]->_errorMsg, $response->_errors[0]->_errorNum); // find out the structure of ERP-ONE's errors
        }

        return $response;
    }

    /**
     * Get the company being used for data access
     * 
     * @return string
     */
    public function getCompany() {
        return $this->params->get('app.erp.company');
    }

    /**
     * Get the warehouse being used for product lookups
     * 
     * @return string
     */
    public function getWarehouse() {
        return $this->params->get('app.erp.warehouse');
    }

    /**
     * @return ProductRepository
     */
    public function getProductRepository() {
        return new ProductRepository($this);
    }

    /**
     * @return SalesOrderRepository
     */
    public function getSalesOrderRepository() {
        return new SalesOrderRepository($this);
    }

    /**
     * @return ShipmentRepository
     */
    public function getShipmentRepository() {
        return new ShipmentRepository($this);
    }

    /**
     * @return InvoiceRepository
     */
    public function getInvoiceRepository() {
        return new InvoiceRepository($this);
    }

    /**
     * @return CustomerRepository
     */
    public function getCustomerRepository() {
        return new CustomerRepository($this);
    }

    /**
     * @return PackerLogEntryRepository
     */
    public function getPackerLogEntryRepository() {
        return new PackerLogEntryRepository($this);
    }

}
