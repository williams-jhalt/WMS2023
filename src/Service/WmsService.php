<?php

namespace App\Service;

use App\Repository\Wms\WeborderRepository;

class WmsService {
    
    protected $client;
    
    public function __construct(string $wsdl, string $username, string $password) {
        $this->client = new \SoapClient($wsdl, [
            'soap_version' => SOAP_1_2,
            'login' => $username,
            'password' => $password
        ]);
    }
    
    public function getWeborderRepository() {
        return new WeborderRepository($this->client);
    }

}
