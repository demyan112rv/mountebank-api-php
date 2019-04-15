<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit;

use Demyan112rv\MountebankPHP\Imposter;
use Demyan112rv\MountebankPHP\Response;
use Demyan112rv\MountebankPHP\Stub;
use PHPUnit\Framework\TestCase;

class ImposterTest extends TestCase
{
    public function testFill(): void
    {
        $imposter = new Imposter();
        $imposter->setName('Test imposter')
            ->setPort(1234)
            ->setProtocol(Imposter::PROTOCOL_HTTP)
            ->setStubs([new Stub()])
            ->setKey('key')
            ->setCert('cert')
            ->setMutualAuth(true)
            ->setDefaultResponse(new Response())
            ->setAllowCORS(true);

        $this->assertNotEmpty($imposter->getName());
        $this->assertNotEmpty($imposter->getPort());
        $this->assertNotEmpty($imposter->getProtocol());
        $this->assertNotEmpty($imposter->getKey());
        $this->assertNotEmpty($imposter->getCert());
        $this->assertTrue($imposter->getDefaultResponse() instanceof Response);
        $this->assertTrue($imposter->isMutualAuth());
        $this->assertTrue($imposter->isAllowCORS());
        $this->assertTrue($imposter->getStubs()[0] instanceof Stub);
        $this->assertCount(1, $imposter->getStubs());

        $imposter->addStub(new Stub());

        $this->assertCount(2, $imposter->getStubs());
    }

    public function testWrongType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $imposter = new Imposter();
        $imposter->setProtocol('Wrong protocol');
    }
}