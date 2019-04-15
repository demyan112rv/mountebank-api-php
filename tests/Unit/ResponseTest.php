<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit;

use Demyan112rv\MountebankPHP\Response\Behavior;
use Demyan112rv\MountebankPHP\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testFill(): void
    {
        $behavior = new Behavior();
        $behavior->setType(Behavior::TYPE_WAIT)->setConfig((new Behavior\Config\Wait())->setValue(500));

        $response = new Response(Response::TYPE_IS);
        $response->setConfig([
                'statusCode' => 200,
                'headers' => ['Content-Type' => 'application/json'],
                'body' => ['foo' => 'bar']
            ])
            ->setInjectJs('Inject js string')
            ->setBehaviors([$behavior]);

        $this->assertNotEmpty($response->getType());
        $this->assertNotEmpty($response->getConfig());
        $this->assertNotEmpty($response->getInjectJs());
        $this->assertNotEmpty($response->getBehaviors());
        $this->assertCount(1, $response->getBehaviors());

        $response->addBehavior($behavior);

        $this->assertCount(2, $response->getBehaviors());
    }

    public function testWrongType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Response('Wrong type');
    }
}