<?php

namespace App\Tests\Repository\Wholesale;

use App\Repository\Wholesale\ManufacturerRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;

class ManufacturerRepositoryTest extends TestCase
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
            ->willReturn(['items 0-100/499']);

        $fh = Utils::tryFopen(__DIR__ . '/manufacturers.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new ManufacturerRepository($mockGuzzle);
        $response = $repo->findAll(100, 0);

        $this->assertSame("ANP", $response->getItems()[0]->getCode());

    }

    public function testFind(): void
    {

        $mockGuzzleResponse = $this->createMock(Response::class);
        $mockGuzzleResponse->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(200);

        $fh = Utils::tryFopen(__DIR__ . '/manufacturers_find.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new ManufacturerRepository($mockGuzzle);
        $response = $repo->find("262");

        $this->assertSame("ANP", $response->getCode());

    }
}
