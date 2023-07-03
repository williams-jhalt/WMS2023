<?php

namespace App\Service;

use App\Service\ConnectShip\AMP\ListWindowsPrintersRequest;
use App\Model\ConnectShip\Package;
use App\Model\ConnectShip\Shipment;
use DateInterval;
use DatePeriod;
use DateTime;
use SoapClient;

class ConnectshipService {

    protected $client;

    public function __construct(string $wsdl_url) {
        $this->client = new SoapClient($wsdl_url, array('soap_version' => SOAP_1_2));
    }

    /**
     * 
     * @param string $ucc
     * @return string|null
     */
    public function getTrackingNumberByUcc($ucc) {

        $resp = $this->client->ListCarriers([]);

        $result = $resp->result;

        foreach ($result->resultData->item as $carrier) {
            $searchRequest = [
                'carrier' => $carrier->symbol,
                'filters' => [
                    'consigneeReference' => $ucc
                ]
            ];

            $searchResp = $this->client->Search($searchRequest);

            $searchResult = $searchResp->result;
            $item = $searchResult->resultData->item;

            if ($item !== null) {
                return $item[0]->resultData->trackingNumber;
            }
        }

        return null;
        
    }

    /**
     * 
     * @param string $ucc
     * @return Shipment[]
     */
    public function getShippingDataByUcc($ucc) {

        $resp = $this->client->ListCarriers([]);

        $result = $resp->result;

        $shipments = [];

        foreach ($result->resultData->item as $carrier) {
            $searchRequest = [
                'carrier' => $carrier->symbol,
                'filters' => [
                    'consigneeReference' => $ucc
                ]
            ];

            $searchResp = $this->client->Search($searchRequest);

            $searchResult = $searchResp->result;
            $item = $searchResult->resultData->item;

            if ($item !== null) {

                foreach ($item as $shippingData) {

                    $shipment = new Shipment();
                    $shipment->setTrackingNumber($shippingData->resultData->trackingNumber);
                    $shipments[] = $shipment;

                }
            }
        }

        return $shipments;
    }

    /**
     * 
     * @param string $trackingNumber
     * @return Shipment[]
     */
    public function getShippingDataByTrackingNumber($trackingNumber) {
        

        $resp = $this->client->ListCarriers([]);


        $result = $resp->result;

        $shipments = [];

        foreach ($result->resultData->item as $carrier) {

            $searchRequest = [
                'carrier' => $carrier->symbol,
                'filters' => [
                    'trackingNumber' => $trackingNumber
                ]
            ];

            $searchResp = $this->client->Search($searchRequest);

            $searchResult = $searchResp->result;
            $item = $searchResult->resultData->item;

            if ($item !== null) {

                foreach ($item as $shippingData) {

                    $shipment = new Shipment();
                    $shipment->setTrackingNumber($shippingData->resultData->trackingNumber);
                    $shipments[] = $shipment;

                }
            }
        }

        return $shipments;

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
        

        $services = $this->client->ListServices([]);
        $carriers = $this->client->ListCarriers([]);
        
        $svc = array();
        
        foreach ($services->result->resultData->item as $service) {
            $svc[$service->symbol] = $service->name;
        }

        $response = array();

        foreach ($carriers->result->resultData->item as $carrier) {

            foreach ($period as $date) {

                $searchRequest = [
                    'carrier' => $carrier->symbol,
                    'filters' => [
                        'shipdate' => $date->format('Y-m-d')
                    ]
                ];

                $result = $this->client->Search($searchRequest);

                $packages = $result->result->resultData->item;

                if ($packages !== null) {
                    foreach ($packages as $package) {
                        $resultData = $package->resultData;
                        $pkg = new Package();
                        if ($resultData->dimension !== null) {
                            $pkg->setDimUnit($resultData->dimension->unit);
                            $pkg->setHeight($resultData->dimension->height);
                            $pkg->setLength($resultData->dimension->length);
                            $pkg->setWidth($resultData->dimension->width);
                        }
                        $pkg->setWeight($resultData->weight->amount);
                        if ($resultData->total !== null) {
                            $pkg->setFreightCharge($resultData->total->amount);
                        }
                        if ($resultData->fuelSurcharge !== null) {
                            $pkg->setFuelSurcharge($resultData->fuelSurcharge->amount);
                        }
                        $pkg->setConsigneePostalCode($resultData->consignee->postalCode);
                        $pkg->setConsigneeCountry($resultData->consignee->countryCode);
                        $pkg->setConsigneeState($resultData->consignee->stateProvince);
                        $pkg->setShippingMethod($svc[$resultData->service]);
                        $pkg->setShipDate($resultData->shipdate);
                        $response[] = $pkg;
                    }
                }
            }
            
            
        }
        
        return $response;
    }

}
