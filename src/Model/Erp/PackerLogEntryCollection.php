<?php

namespace App\Model\Erp;

use JMS\Serializer\Annotation as JMS;

class PackerLogEntryCollection implements \Iterator {

    /**
     * @JMS\Type("array<App\Model\Erp\PackerLogEntry>")
     * @var PackerLogEntry[]
     */
    protected $packerLogEntries;
    private $position = 0;
    
    /**
     * @param PackerLogEntry[] $packerLogEntries
     */
    public function __construct(array $packerLogEntries) {
        $this->position = 0;
        $this->packerLogEntries = $packerLogEntries;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): PackerLogEntry {
        return $this->packerLogEntries[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->packerLogEntries[$this->position]);
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
