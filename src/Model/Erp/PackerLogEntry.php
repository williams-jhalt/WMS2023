<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Erp;

/**
 * Description of PackerLogEntry
 *
 * @author johnh
 */
class PackerLogEntry {

    private $userId;
    private $ucc;
    private $qtyShipped;

    public function getUserId() {
        return $this->userId;
    }

    public function getUcc() {
        return $this->ucc;
    }

    public function getQtyShipped() {
        return $this->qtyShipped;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    public function setUcc($ucc) {
        $this->ucc = $ucc;
        return $this;
    }

    public function setQtyShipped($qtyShipped) {
        $this->qtyShipped = $qtyShipped;
        return $this;
    }

}
