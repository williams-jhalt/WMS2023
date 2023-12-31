<?php

namespace App\Repository\Erp;

use App\Model\Erp\Customer;
use App\Model\Erp\CustomerCollection;

class CustomerRepository extends AbstractRepository implements CustomerRepositoryInterface {

    /**
     * 
     * @param integer $limit
     * @param integer $offset
     * @return CustomerCollection
     */
    public function findAll($limit = 1000, $offset = 0, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $query = "FOR EACH customer NO-LOCK "
                . "WHERE customer.company_cu = '{$company}'";

        $fields = "customer.customer,"
                . "customer.name";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new Customer();
            $item->setCustomerNumber($erpItem->customer_customer);
            $item->setName($erpItem->customer_name);
            $result[] = $item;
        }

        return new CustomerCollection($result);
    }

    /**
     * 
     * @param string $searchTerms
     * @param integer $limit
     * @param integer $offset
     * @return CustomerCollection
     */
    public function findByTextSearch($searchTerms, $limit = 1000, $offset = 0, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $query = "FOR EACH customer NO-LOCK "
                . "WHERE customer.company_cu = '{$company}' "
                . "AND customer.sy_lookup MATCHES '*{$searchTerms}*'";

        $fields = "customer.customer,"
                . "customer.name";

        $response = $this->erp->read($query, $fields, $limit, $offset);

        $result = array();

        foreach ($response as $erpItem) {
            $item = new Customer();
            $item->setCustomerNumber($erpItem->customer_customer);
            $item->setName($erpItem->customer_name);
            $result[] = $item;
        }

        return new CustomerCollection($result);
    }

    /**
     * 
     * @param string $customerNumber
     * @return Customer|null
     */
    public function getByCustomerNumber($customerNumber, $company = null) {

        if ($company == null) {
            $company = $this->erp->getCompany();
        } else {
            if (array_search($company, $this->erp->getAvailableCompanies()) === false) {
                throw new \Exception("INVALID COMPANY SELECTED");
            }
        }

        $query = "FOR EACH customer NO-LOCK "
                . "WHERE customer.company_cu = '{$company}' "
                . "AND customer.customer EQ '{$customerNumber}'";

        $fields = "customer.customer,"
                . "customer.name";

        $response = $this->erp->read($query, $fields, 1);

        if (sizeof($response) == 0) {
            return null;
        }

        $erpItem = $response[0];

        $item = new Customer();
        $item->setCustomerNumber($erpItem->customer_customer);
        $item->setName($erpItem->customer_name);

        return $item;
    }

}
