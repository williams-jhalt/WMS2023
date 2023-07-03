<?php

namespace App\Service;

use GuzzleHttp\Client;
use App\Repository\Wholesale\CategoryRepository;
use App\Repository\Wholesale\ManufacturerRepository;
use App\Repository\Wholesale\ProductImageRepository;
use App\Repository\Wholesale\ProductRepository;
use App\Repository\Wholesale\ProductTypeRepository;

class WholesaleService {
    
    private $wholesaleUrl;
    
    public function __construct(string $wholesaleUrl) {        
        $this->wholesaleUrl = $wholesaleUrl;
    }
    
    public function getCategoryRepository(): CategoryRepository {
        return new CategoryRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
    public function getManufacturerRepository(): ManufacturerRepository {
        return new ManufacturerRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
    public function getProductImageRepository(): ProductImageRepository {
        return new ProductImageRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
    public function getProductRepository(): ProductRepository {
        return new ProductRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
    public function getProductTypeRepository(): ProductTypeRepository {
        return new ProductTypeRepository(new Client(['base_uri' => $this->wholesaleUrl]));
    }
    
}