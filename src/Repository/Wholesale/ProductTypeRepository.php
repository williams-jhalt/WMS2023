<?php

namespace App\Repository\Wholesale;

use Exception;
use GuzzleHttp\Client;
use App\Model\Wholesale\ProductType;
use App\Model\Wholesale\ProductTypeCollection;

class ProductTypeRepository {

    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * 
     * @param int $limit
     * @param int $offset
     * @return ProductTypeCollection
     * @throws Exception
     */
    public function findAll($limit = 100, $offset = 0) {

        $res = $this->client->get('/rest/product-types', [
            'query' => [
                'format' => 'json',
                'start' => $offset,
                'limit' => $limit
            ]
        ]);

        $range = $res->getHeader('X-Content-Range');

        $matches = array();

        preg_match('/items (\d+)-(\d+)\/(\d+)/', $range[0], $matches);

        $data = json_decode($res->getBody());

        $response = new ProductTypeCollection();
        $response->setOffset($matches[1]);
        $response->setLimit($matches[2]);
        $response->setTotal($matches[3]);

        $productTypes = array();

        foreach ($data->types as $productType) {
            $productTypes[] = $this->loadProductType($productType);
        }

        $response->setItems($productTypes);

        return $response;
    }

    /**
     * 
     * @param mixed $id
     * @return ProductType
     * @throws Exception
     */
    public function find($id) {

        $res = $this->client->get('/rest/product-types/' . $id, [
            'query' => [
                'format' => 'json'
            ]
        ]);

        if ($res->getStatusCode() != 200) {
            throw new Exception("Could not get data");
        }

        $data = json_decode($res->getBody());
        
        if ($data->type == null) {
            return null;
        }

        return $this->loadProductType($data->type);
    }

    /**
     * 
     * @param stdClass $data
     * @return ProductType
     */
    private function loadProductType($data) {
        $t = new ProductType();
        $t->setId($data->id)
                ->setCode($data->code)
                ->setName($data->name)
                ->setActive($data->active)
                ->setVideo($data->video);
        return $t;
    }

}
