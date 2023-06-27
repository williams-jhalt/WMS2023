<?php

namespace App\Service;

use Doctrine\Common\Cache\FilesystemCache;
use ErpBundle\Repository\ServerCustomerRepository;
use ErpBundle\Repository\ServerInvoiceRepository;
use ErpBundle\Repository\ServerPackerLogEntryRepository;
use ErpBundle\Repository\ServerProductRepository;
use ErpBundle\Repository\ServerSalesOrderRepository;
use ErpBundle\Repository\ServerShipmentRepository;
use Exception;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class ErpServerService implements ErpService {

    private $_grantToken;
    private $_accessToken;
    private $_server;
    private $_username;
    private $_password;
    private $_grantTime;
    private $_cache;
    private $_cacheId;
    private $_company;
    private $_appname;
    private $_warehouse;

    /**
     * 
     * @param string $server
     * @param string $username
     * @param string $password
     * @param string $company
     * @param string $appname
     * @param string $warehouse
     */
    public function __construct(string $server, string $username, string $password, string $company, string $appname, string $warehouse = "MAIN") {

        $this->_cache = new FilesystemCache(sys_get_temp_dir());
        $this->_cacheId = md5("erp_token:{$server}:{$company}:{$appname}");

        $this->_server = $server;
        $this->_username = $username;
        $this->_password = $password;
        $this->_company = $company;
        $this->_appname = $appname;
        $this->_warehouse = $warehouse;

        if (($serializedData = $this->_cache->fetch($this->_cacheId)) !== false) {
            $data = unserialize($serializedData);
            $this->_grantToken = $data[0];
            $this->_accessToken = $data[1];
            $this->_grantTime = $data[2];
        }
    }

    /**
     * Retrieves API token from ERP
     * 
     * @param resource $ch
     * @throws ErpServiceException
     */
    private function _getGrantToken($ch = null) {

        $closeCurlWhenFinished = false;

        if ($ch === null) {
            $ch = curl_init();
            $closeCurlWhenFinished = true;
        }

        curl_setopt($ch, CURLOPT_URL, $this->_server . "/distone/rest/service/authorize/grant");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            'client' => $this->_appname,
            'company' => $this->_company,
            'username' => $this->_username,
            'password' => $this->_password
        )));

        $response = json_decode(curl_exec($ch));

        if (isset($response->_errors)) {
            $this->_cache->delete($this->_cacheId);
            throw new ErpServiceException($response->_errors[0]->_errorMsg, $response->_errors[0]->_errorNum); // find out the structure of ERP-ONE's errors
        }

        $this->_grantToken = $response->grant_token;
        $this->_accessToken = $response->access_token;

        $this->_grantTime = time();

        $this->_cache->save($this->_cacheId, serialize(array(
            $this->_grantToken,
            $this->_accessToken,
            $this->_grantTime
        )));

        if ($closeCurlWhenFinished) {
            curl_close($ch);
        }
    }

    /**
     * Refreshes API token from ERP if expired
     * 
     * @param resource $ch
     * @return null
     */
    private function _refreshToken($ch = null) {

        $closeCurlWhenFinished = false;

        if ($ch === null) {
            $ch = curl_init();
            $closeCurlWhenFinished = true;
        }

        if ($this->_grantTime === null || $this->_grantToken === null || $this->_accessToken === null) {
            $this->_getGrantToken($ch);
        }

        if ($this->_grantTime > (time() - (60 * 3))) {
            return;
        }

        curl_setopt($ch, CURLOPT_URL, $this->_server . "/distone/rest/service/authorize/access");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            'client' => $this->_appname,
            'company' => $this->_company,
            'grant_token' => $this->_grantToken
        )));

        $response = json_decode(curl_exec($ch));

        if (isset($response->_errors)) {
            $this->_cache->delete($this->_cacheId);
            $this->_getGrantToken($ch);
        }

        $this->_accessToken = $response->access_token;

        $this->_grantTime = time();

        $this->_cache->save($this->_cacheId, serialize(array(
            $this->_grantToken,
            $this->_accessToken,
            $this->_grantTime
        )));

        if ($closeCurlWhenFinished) {
            curl_close($ch);
        }
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
    public function create($table, $records, $triggers = true, $ch = null) {

        $closeCurlWhenFinished = false;

        if ($ch === null) {
            $ch = curl_init();
            $closeCurlWhenFinished = true;
        }

        $this->_refreshToken($ch);

        curl_setopt($ch, CURLOPT_URL, $this->_server . "/distone/rest/service/data/create");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $this->_accessToken
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
        $this->_refreshToken($ch);

        curl_setopt($ch, CURLOPT_URL, $this->_server . "/distone/rest/service/data/read");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: ' . $this->_accessToken
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
        $this->_refreshToken($ch);

        $queryData = array();

        $queryData['item'] = $itemNumber;

        if ($customer !== null) {
            $queryData['customer'] = $customer;
        }

        $queryData['quantity'] = $quantity;
        $queryData['unit'] = $uom;

        $query = http_build_query($queryData);

        curl_setopt($ch, CURLOPT_URL, $this->_server . "/distone/rest/service/price/fetch?" . $query);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . $this->_accessToken
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

        $this->_refreshToken($ch);

        $queryData = array(
            'type' => $type,
            'record' => $record,
            'seq' => $seq
        );

        $query = http_build_query($queryData);

        curl_setopt($ch, CURLOPT_URL, $this->_server . "/distone/rest/service/form/fetch?" . $query);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . $this->_accessToken
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
        return $this->_company;
    }

    /**
     * Get the warehouse being used for product lookups
     * 
     * @return string
     */
    public function getWarehouse() {
        return $this->_warehouse;
    }

    /**
     * @return ServerProductRepository
     */
    public function getProductRepository() {
        return new ServerProductRepository($this);
    }

    /**
     * @return ServerSalesOrderRepository
     */
    public function getSalesOrderRepository() {
        return new ServerSalesOrderRepository($this);
    }

    /**
     * @return ServerShipmentRepository
     */
    public function getShipmentRepository() {
        return new ServerShipmentRepository($this);
    }

    /**
     * @return ServerInvoiceRepository
     */
    public function getInvoiceRepository() {
        return new ServerInvoiceRepository($this);
    }

    /**
     * @return ServerCustomerRepository
     */
    public function getCustomerRepository() {
        return new ServerCustomerRepository($this);
    }

    /**
     * @return ServerPackerLogEntryRepository
     */
    public function getPackerLogEntryRepository() {
        return new ServerPackerLogEntryRepository($this);
    }

}
