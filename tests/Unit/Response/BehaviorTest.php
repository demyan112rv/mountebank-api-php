<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Response;

use Demyan112rv\MountebankPHP\Response\Behavior;
use PHPUnit\Framework\TestCase;

class BehaviorTest extends TestCase
{
    public function testFill(): void
    {
        $behavior = new Behavior(Behavior::TYPE_WAIT);
        $behavior->setConfig((new Behavior\Config\Wait())->setValue(500));
        $this->assertNotEmpty($behavior->getType());
        $this->assertNotEmpty($behavior->getConfig());
        $this->assertEquals(Behavior::TYPE_WAIT, $behavior->getType());
        $this->assertTrue($behavior->getConfig() instanceof Behavior\Config\Wait);
    }

    public function testWrongType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Behavior('Wrong type');
    }
}