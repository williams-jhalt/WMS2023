<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class PackerLogEntryCollection {

    /**
     * @JMS\Type("array<App\Model\Erp\PackerLogEntry>")
     * @var PackerLogEntry[]
     */
    protected $packerLogEntries;
    
    /**
     * @param PackerLogEntry[] $packerLogEntries
     */
    public function __construct(array $packerLogEntries) {
        $this->packerLogEntries = $packerLogEntries;
    }

    /**
     * 
     * @return PackerLogEntry[]
     */
    function getPackerLogEntries() {
        return $this->packerLogEntries;
    }

    /**
     * 
     * @param PackerLogEntry[] $packerLogEntries
     * @return ProductCollection
     */
    function setPackerLogEntries(array $packerLogEntries) {
        $this->packerLogEntries = $packerLogEntries;
        return $this;
    }

}
