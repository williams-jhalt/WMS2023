<?php

namespace App\Service;

use App\Service\ConnectShip\AMP\AMPServices;
use App\Service\ConnectShip\AMP\DataDictionary;
use App\Service\ConnectShip\AMP\ListCarriersRequest;
use App\Service\ConnectShip\AMP\ListPrinterDevicesRequest;
use App\Service\ConnectShip\AMP\ListServicesRequest;
use App\Service\ConnectShip\AMP\ListWindowsPrintersRequest;
use App\Service\ConnectShip\AMP\SearchRequest;
use App\Model\ConnectShip\Package;
use DateInterval;
use DatePeriod;
use DateTime;

class ConnectshipService {

    private $client;

    public function __construct(string $wsdl_url) {
        $this->client = new AMPServices(array('soap_version' => SOAP_1_2), $wsdl_url);
    }

    /**
     * 
     * @param string $ucc
     * @return string
     */
    public function getTrackingNumberByUcc($ucc) {

        $service = $this->client;

        $carriersResponse = $service->ListCarriers(new ListCarriersRequest(null, null, null, null));

        foreach ($carriersResponse->getResult()->getResultData()->getItem() as $carrier) {
            $searchRequest = new SearchRequest($carrier->getSymbol(), null, null, null, null, null, null);
            $searchRequest->setFilters(array('consigneeReference' => $ucc));
            $searchResponse = $service->Search($searchRequest);
            $item = $searchResponse->getResult()->getResultData()->getItem();
            if ($item !== null && $item[0]->getResultData()->getTrackingNumber() != null) {
                return $item[0]->getResultData()->getTrackingNumber();
            }
        }
    }

    /**
     * 
     * @param string $ucc
     * @return DataDictionary[]
     */
    public function getShippingDataByUcc($ucc) {

        $service = $this->client;

        $carriersResponse = $service->ListCarriers(new ListCarriersRequest(null, null, null, null));

        foreach ($carriersResponse->getResult()->getResultData()->getItem() as $carrier) {
            $searchRequest = new SearchRequest($carrier->getSymbol(), null, null, null, null, null, null);
            $searchRequest->setFilters(array('consigneeReference' => $ucc));
            $searchResponse = $service->Search($searchRequest);
            $item = $searchResponse->getResult()->getResultData()->getItem();
            if ($item !== null) {
                return $item;
            }
        }
    }

    /**
     * 
     * @param string $trackingNumber
     * @return DataDictionary[]
     */
    public function getShippingDataByTrackingNumber($trackingNumber) {

        $service = $this->client;

        $carriersResponse = $service->ListCarriers(new ListCarriersRequest(null, null, null, null));

        foreach ($carriersResponse->getResult()->getResultData()->getItem() as $carrier) {
            $searchRequest = new SearchRequest($carrier->getSymbol(), null, null, null, null, null, null);
            $searchRequest->setFilters(array('trackingNumber' => $trackingNumber));
            $searchResponse = $service->Search($searchRequest);
            $item = $searchResponse->getResult()->getResultData()->getItem();
            if ($item !== null) {
                return $item;
            }
        }
    }

    public function getPrinterNames() {
        $response = $this->client->ListWindowsPrinters(new ListWindowsPrintersRequest(null, null, null, null));
        return $response->getResult()->getResultData()->getItem();
    }

    /**
     * 
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @return Package[]
     */
    public function getShippingDataByDate(DateTime $startDate, DateTime $endDate) {

        $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
        

        $services = $this->client->ListServices(new ListServicesRequest(null, null, null, null));
        $carriers = $this->client->ListCarriers(new ListCarriersRequest(null, null, null, null));
        
        $svc = array();
        
        foreach ($services->getResult()->getResultData()->getItem() as $service) {
            $svc[$service->getSymbol()] = $service->getName();
        }

        $response = array();

        foreach ($carriers->getResult()->getResultData()->getItem() as $carrier) {

            foreach ($period as $date) {

                $filter = new DataDictionary(null);
                $filter->setShipdate($date->format('Y-m-d'));
                $search = new SearchRequest($carrier->getSymbol(), $filter, null, null, null, null, null);
                $search->setGlobalSearch(true);
                $result = $this->client->Search($search);

                $packages = $result->getResult()->getResultData()->getItem();

                if ($packages !== null) {
                    foreach ($packages as $package) {
                        $resultData = $package->getResultData();
                        $pkg = new Package();
                        if ($resultData->getDimension() !== null) {
                            $pkg->setDimUnit($resultData->getDimension()->getUnit());
                            $pkg->setHeight($resultData->getDimension()->getHeight());
                            $pkg->setLength($resultData->getDimension()->getLength());
                            $pkg->setWidth($resultData->getDimension()->getWidth());
                        }
                        $pkg->setWeight($resultData->getWeight()->getAmount());
                        if ($resultData->getTotal() !== null) {
                            $pkg->setFreightCharge($resultData->getTotal()->getAmount());
                        }
                        if ($resultData->getFuelSurcharge() !== null) {
                            $pkg->setFuelSurcharge($resultData->getFuelSurcharge()->getAmount());
                        }
                        $pkg->setConsigneePostalCode($resultData->getConsignee()->getPostalCode());
                        $pkg->setConsigneeCountry($resultData->getConsignee()->getCountryCode());
                        $pkg->setConsigneeState($resultData->getConsignee()->getStateProvince());
                        $pkg->setShippingMethod($svc[$resultData->getService()]);
                        $pkg->setShipDate($resultData->getShipdate());
                        $response[] = $pkg;
                    }
                }
            }
            
            
        }
        
        return $response;
    }

}
