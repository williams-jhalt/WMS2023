<?php

namespace App\Tests\Repository\Wholesale;

use App\Repository\Wholesale\ProductImageRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;

class ProductImageRepositoryTest extends TestCase
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
            ->willReturn(['items 0-100/156318']);

        $fh = Utils::tryFopen(__DIR__ . '/product_images.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new ProductImageRepository($mockGuzzle);
        $response = $repo->findAll(100, 0);

        $this->assertSame("18578", $response->getItems()[0]->getProductId());

    }

    public function testFindBySku(): void
    {

        $mockGuzzleResponse = $this->createMock(Response::class);
        $mockGuzzleResponse->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(200);
        $mockGuzzleResponse->expects($this->any())
            ->method('getHeader')
            ->with($this->stringContains('X-Content-Range'))
            ->willReturn(['items 0-2/2']);

        $fh = Utils::tryFopen(__DIR__ . '/product_images_find_by_sku.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new ProductImageRepository($mockGuzzle);
        $response = $repo->findBySku("AL1007XO");

        $this->assertSame("AL1007XO.jpg", $response->getItems()[0]->getFilename());

    }

    public function testFind(): void
    {

        $mockGuzzleResponse = $this->createMock(Response::class);
        $mockGuzzleResponse->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(200);

        $fh = Utils::tryFopen(__DIR__ . '/product_images_find.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new ProductImageRepository($mockGuzzle);
        $response = $repo->find("1");

        $this->assertSame("18578", $response->getProductId());

    }
}
