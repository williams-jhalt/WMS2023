<?php

namespace App\Tests\Service;

use App\Service\ConnectshipService;
use PHPUnit\Framework\MockObject\MockObject;

class ConnectshipServiceTestService extends ConnectshipService {

    public function __construct(MockObject $client) {
        $this->client = $client;
    }

}