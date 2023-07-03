<?php

namespace App\Repository\Wholesale;

use Exception;
use GuzzleHttp\Client;
use App\Model\Wholesale\Manufacturer;
use App\Model\Wholesale\ManufacturerCollection;

class ManufacturerRepository {

    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * 
     * @param int $limit
     * @param int $offset
     * @return ManufacturerCollection
     * @throws Exception
     */
    public function findAll($limit = 100, $offset = 0) {

        $res = $this->client->get('/rest/manufacturers', [
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

        $response = new ManufacturerCollection();
        $response->setOffset($matches[1]);
        $response->setLimit($matches[2]);
        $response->setTotal($matches[3]);

        $manufacturers = array();

        foreach ($data->manufacturers as $manufacturer) {
            $manufacturers[] = $this->loadManufacturer($manufacturer);
        }

        $response->setItems($manufacturers);

        return $response;
    }

    /**
     * 
     * @param mixed $id
     * @return Manufacturer|null
     * @throws Exception
     */
    public function find($id) {

        $res = $this->client->get('/rest/manufacturers/' . $id, [
            'query' => [
                'format' => 'json'
            ]
        ]);

        if ($res->getStatusCode() != 200) {
            throw new Exception("Could not get data");
        }

        $data = json_decode($res->getBody());
        
        if ($data->manufacturer == null) {
            return null;
        }

        return $this->loadManufacturer($data->manufacturer);
    }

    /**
     * 
     * @param \stdClass $data
     * @return Manufacturer
     */
    private function loadManufacturer($data) {
        $t = new Manufacturer();
        $t->setId($data->id)
                ->setCode($data->code)
                ->setName($data->name)
                ->setActive($data->active)
                ->setVideo($data->video);
        return $t;
    }

}
