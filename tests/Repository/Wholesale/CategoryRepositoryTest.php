<?php

namespace App\Tests\Repository\Wholesale;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;
use App\Repository\Wholesale\CategoryRepository;

class CategoryRepositoryTest extends TestCase
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
            ->willReturn(['items 0-100/235']);

        $fh = Utils::tryFopen(__DIR__ . '/categories.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new CategoryRepository($mockGuzzle);
        $response = $repo->findAll(100, 0);

        $this->assertSame("811", $response->getItems()[0]->getCode());

    }

    public function testFindByParent(): void
    {

        $mockGuzzleResponse = $this->createMock(Response::class);
        $mockGuzzleResponse->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(200);
        $mockGuzzleResponse->expects($this->any())
            ->method('getHeader')
            ->with($this->stringContains('X-Content-Range'))
            ->willReturn(['items 0-6/6']);

        $fh = Utils::tryFopen(__DIR__ . '/categories_find_by_parent.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new CategoryRepository($mockGuzzle);
        $response = $repo->FindByParent("818");

        $this->assertSame("818", $response->getItems()[0]->getParentId());

    }

    public function testFind(): void
    {

        $mockGuzzleResponse = $this->createMock(Response::class);
        $mockGuzzleResponse->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(200);

        $fh = Utils::tryFopen(__DIR__ . '/categories_find.json', 'r');
        $mockGuzzleResponse->expects($this->any())
            ->method('getBody')
            ->willReturn(Utils::streamFor($fh));

        $mockGuzzle = $this->createMock(Client::class);
        $mockGuzzle->expects($this->any())
            ->method('get')
            ->willReturn($mockGuzzleResponse);

        $repo = new CategoryRepository($mockGuzzle);
        $response = $repo->find("818");

        $this->assertSame("811", $response->getCode());

    }
}