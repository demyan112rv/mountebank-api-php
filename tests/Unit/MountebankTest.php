<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit;

use Demyan112rv\MountebankPHP\Mountebank;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class MountebankTest extends TestCase
{
    public function testFill(): void
    {
        $responseMock = $this->createMock(Response::class);

        $mockClient = $this->createMock(Client::class);
        $mockClient->method('request')->willReturnReference($responseMock);

        $mb = new Mountebank($mockClient);
        $mb->setHost('http://test.com')->setPort(1234);

        $this->assertEquals('http://test.com', $mb->getHost());
        $this->assertEquals(1234, $mb->getPort());
        $this->assertEquals('http://test.com:1234/' . Mountebank::URI_CONFIG, $mb->getConfigUrl());
        $this->assertEquals('http://test.com:1234/' . Mountebank::URI_LOGS, $mb->getLogsUrl());
        $this->assertEquals('http://test.com:1234/' . Mountebank::URI_IMPOSTERS, $mb->getImpostersUrl());
    }
}