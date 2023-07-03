<?php

namespace App\Repository\Wholesale;

use DateTime;
use Exception;
use GuzzleHttp\Client;
use App\Model\Wholesale\Product;
use App\Model\Wholesale\ProductCollection;

class ProductRepository {

    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * 
     * @param int $limit
     * @param int $offset
     * @return ProductCollection
     * @throws Exception
     */
    public function findAll($limit = 100, $offset = 0) {

        $res = $this->client->get('/rest/products', [
            'query' => [
                'format' => 'json',
                'start' => $offset,
                'limit' => $limit
            ]
        ]);

        if ($res->getStatusCode() != 200 && $res->getStatusCode() != 206) {
            throw new Exception("Could not get data");
        }

        $range = $res->getHeader('X-Content-Range');

        $matches = array();

        preg_match('/items (\d+)-(\d+)\/(\d+)/', $range[0], $matches);

        $data = json_decode($res->getBody());

        $response = new ProductCollection();
        $response->setOffset($matches[1]);
        $response->setLimit($matches[2]);
        $response->setTotal($matches[3]);

        $products = array();

        foreach ($data->products as $product) {
            $products[] = $this->loadProduct($product);
        }

        $response->setItems($products);

        return $response;
    }

    public function find($id) {

        $res = $this->client->get('/rest/products/' . $id, [
            'query' => [
                'format' => 'json'
            ]
        ]);

        if ($res->getStatusCode() != 200) {
            throw new Exception("Could not get data");
        }

        $data = json_decode($res->getBody());

        return $this->loadProduct($data->product);
    }

    /**
     * 
     * @param int $limit
     * @param int $offset
     * @return ProductCollection
     * @throws Exception
     */
    public function findBySearchTerms($searchTerms, $limit = 100, $offset = 0): ProductCollection {

        $res = $this->client->get('/rest/products', [
            'query' => [
                'format' => 'json',
                'start' => $offset,
                'limit' => $limit,
                'search_terms' => $searchTerms
            ]
        ]);

        if ($res->getStatusCode() != 200 && $res->getStatusCode() != 206) {
            throw new Exception("Could not get data");
        }

        $range = $res->getHeader('X-Content-Range');

        $matches = array();

        preg_match('/items (\d+)-(\d+)\/(\d+)/', $range[0], $matches);

        $data = json_decode($res->getBody());

        $response = new ProductCollection();
        $response->setOffset($matches[1]);
        $response->setLimit($matches[2]);
        $response->setTotal($matches[3]);

        $products = array();

        foreach ($data->products as $product) {
            $products[] = $this->loadProduct($product);
        }

        $response->setItems($products);

        return $response;
    }

    private function loadProduct($data) {
        
        if ($data == null || $data == "Product Not Found") {
            return null;
        }
        
        $t = new Product();
        $t->setId($data->id)
                ->setActive($data->active)
                ->setBarcode($data->barcode)
                ->setColor($data->color)
                ->setCreatedOn($data->created_on)
                ->setUpdatedOn($data->updated_on)
                ->setDescription($data->description)
                ->setDiameter($data->diameter)
                ->setDiscountable($data->discountable)
                ->setHeight($data->height)
                ->setKeywords($data->keywords)
                ->setLength($data->length)
                ->setManufacturerId($data->manufacturer_id)
                ->setMaterial($data->material)
                ->setMaxDiscountRate($data->max_discount_rate)
                ->setName($data->name)
                ->setOnSale($data->on_sale)
                ->setPrice($data->price)
                ->setReleaseDate(new DateTime($data->release_date))
                ->setReorderQuantity($data->reorder_quantity)
                ->setSaleable($data->saleable)
                ->setSku($data->sku)
                ->setSockQuantity($data->stock_quantity)
                ->setTypeId($data->type_id)
                ->setVideo($data->video)
                ->setWeight($data->weight)
                ->setWidth($data->width)
                ->setBrand($data->brand)
                ->setProductLength($data->product_length)
                ->setInsertableLength($data->insertable_length)
                ->setRealistic($data->realistic)
                ->setBalls($data->balls)
                ->setSuctionCup($data->suction_cup)
                ->setHarness($data->harness)
                ->setVibrating($data->vibrating)
                ->setDoubleEnded($data->double_ended)
                ->setCircumference($data->circumference);
        return $t;
    }

}
