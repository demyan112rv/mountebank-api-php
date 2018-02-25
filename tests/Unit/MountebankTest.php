<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit;

use Demyan112rv\MountebankPHP\Imposter;
use Demyan112rv\MountebankPHP\Mountebank;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class MountebankTest extends TestCase
{
    public function testFill()
    {
        $responseMock = $this->createMock(Response::class);

        $mockClient = $this->createMock(Client::class);
        $mockClient->method('request')->willReturnReference($responseMock);

        $mb = new Mountebank($mockClient);
        $mb->setHost('http://test.com')->setPort(1234);

        $this->assertEquals('http://test.com', $mb->getHost());
        $this->assertEquals(1234, $mb->getPort());

        $imposter = (new Imposter())
            ->setName('Imposter name')
            ->setPort(1234)
            ->setProtocol(Imposter::PROTOCOL_HTTP);

        $response = $mb->removeImposters();
        $this->assertTrue($response instanceof Response);
        $response = $mb->addImposter($imposter);
        $this->assertTrue($response instanceof Response);
        $response = $mb->getImposters();
        $this->assertTrue($response instanceof Response);
    }
}