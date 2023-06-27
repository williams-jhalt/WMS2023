<?php

namespace App\Adapter\LogicBroker;

use App\Model\LogicBroker\Inventory;
use SplFileObject;

abstract class AbstractInventoryAdapter {
    
    /**
     * @var SplFileObject
     */
    protected $file;
    
    public function __construct(SplFileObject $file) {
        $this->file = $file;
    }
    
    abstract public function writeHeader();
    abstract public function writeLine(Inventory $inventory);
    
}