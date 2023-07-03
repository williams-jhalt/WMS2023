<?php

namespace App\Tests\Repository\Wholesale;

use App\Repository\Wholesale\ProductRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {

        $mockGuzzleResponse = $this->createMock(Response::class);
        $mockGuzzleResponse->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(206);
        $mockGuzzleResponse->expects($this->any())
            ->method('getHeader')
            ->with($this->stringContains('X-Content-Range'))
            ->willReturn(['items 0-100/68038']);

        $fh = Utils::tryFopen(__DIR__ . '/products.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new ProductRepository($mockGuzzle);
        $response = $repo->findAll(100, 0);

        $this->assertSame("18578", $response->getItems()[0]->getId());

    }

    public function testFind(): void
    {

        $mockGuzzleResponse = $this->createMock(Response::class);
        $mockGuzzleResponse->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(200);

        $fh = Utils::tryFopen(__DIR__ . '/products_find.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new ProductRepository($mockGuzzle);
        $response = $repo->find("18578");

        $this->assertSame("18578", $response->getId());

    }
    
    public function testFindBySearchTerms(): void
    {

        $mockGuzzleResponse = $this->createMock(Response::class);
        $mockGuzzleResponse->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(200);
        $mockGuzzleResponse->expects($this->any())
            ->method('getHeader')
            ->with($this->stringContains('X-Content-Range'))
            ->willReturn(['items 0-1/1']);

        $fh = Utils::tryFopen(__DIR__ . '/products_find_by_search_terms.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new ProductRepository($mockGuzzle);
        $response = $repo->findBySearchTerms("AL1007XO", 100, 0);

        $this->assertSame("18578", $response->getItems()[0]->getId());

    }
}
