<?php

namespace App\Model\Wholesale;

class ProductImage {

    private $id;
    private $productId;
    private $filename;
    private $imageUrl;
    private $imageThumbUrl;
    private $imageMediumUrl;
    private $imageLargeUrl;
    private $fileType;
    private $altText;
    private $description;
    private $explicit;
    private $primary;
    private $createdOn;
    private $updatedOn;

    public function getId() {
        return $this->id;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function getImageThumbUrl() {
        return $this->imageThumbUrl;
    }

    public function getImageMediumUrl() {
        return $this->imageMediumUrl;
    }

    public function getImageLargeUrl() {
        return $this->imageLargeUrl;
    }

    public function getFileType() {
        return $this->fileType;
    }

    public function getAltText() {
        return $this->altText;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getExplicit() {
        return $this->explicit;
    }

    public function getPrimary() {
        return $this->primary;
    }

    public function getCreatedOn() {
        return $this->createdOn;
    }

    public function getUpdatedOn() {
        return $this->updatedOn;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
        return $this;
    }

    public function setFilename($filename) {
        $this->filename = $filename;
        return $this;
    }

    public function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function setImageThumbUrl($imageThumbUrl) {
        $this->imageThumbUrl = $imageThumbUrl;
        return $this;
    }

    public function setImageMediumUrl($imageMediumUrl) {
        $this->imageMediumUrl = $imageMediumUrl;
        return $this;
    }

    public function setImageLargeUrl($imageLargeUrl) {
        $this->imageLargeUrl = $imageLargeUrl;
        return $this;
    }

    public function setFileType($fileType) {
        $this->fileType = $fileType;
        return $this;
    }

    public function setAltText($altText) {
        $this->altText = $altText;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setExplicit($explicit) {
        $this->explicit = $explicit;
        return $this;
    }

    public function setPrimary($primary) {
        $this->primary = $primary;
        return $this;
    }

    public function setCreatedOn($createdOn) {
        $this->createdOn = $createdOn;
        return $this;
    }

    public function setUpdatedOn($updatedOn) {
        $this->updatedOn = $updatedOn;
        return $this;
    }

}
