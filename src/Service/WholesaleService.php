<?php

namespace App\Service;

use GuzzleHttp\Client;
use WholesaleBundle\Repository\CategoryRepository;
use WholesaleBundle\Repository\ManufacturerRepository;
use WholesaleBundle\Repository\ProductImageRepository;
use WholesaleBundle\Repository\ProductRepository;
use WholesaleBundle\Repository\ProductTypeRepository;

class WholesaleService {
    
    private $wholesaleUrl;
    
    public function __construct(string $wholesaleUrl) {        
        $this->wholesaleUrl = $wholesaleUrl;
    }
    
    public function getCategoryRepository() {
        return new CategoryRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
    public function getManufacturerRepository() {
        return new ManufacturerRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
    public function getProductImageRepository() {
        return new ProductImageRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
    public function getProductRepository() {
        return new ProductRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
    public function getProductTypeRepository() {
        return new ProductTypeRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
}