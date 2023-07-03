<?php

namespace App\Repository\Erp;

use App\Service\ErpService;

abstract class AbstractRepository {

    /**
     * @var ErpService
     */
    protected $erp;

    public function __construct(ErpService $erp) {
        $this->erp = $erp;
    }
    
}