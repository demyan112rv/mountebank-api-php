<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Response\Behavior\Config;

use Demyan112rv\MountebankPHP\Response\Behavior\Config\Decorate;
use PHPUnit\Framework\TestCase;

class DecorateTest extends TestCase
{
    public function testFill(): void
    {
        $config = new Decorate('js string');
        $this->assertNotEmpty($config->getJs());
        $this->assertEquals('js string', $config->getJs());
    }
}