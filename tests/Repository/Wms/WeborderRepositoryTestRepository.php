<?php

namespace App\Tests\Repository\Wms;

use App\Repository\Wms\WeborderRepository;
use PHPUnit\Framework\MockObject\MockObject;

class WeborderRepositoryTestRepository extends WeborderRepository {

    public function __construct(MockObject $client) {
        $this->client = $client;
    }

}