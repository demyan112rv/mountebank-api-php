<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Response\Behavior\Config;

use Demyan112rv\MountebankPHP\Response\Behavior\Config\Repeat;
use PHPUnit\Framework\TestCase;

class RepeatTest extends TestCase
{
    public function testFill(): void
    {
        $config = new Repeat(3);
        $this->assertNotEmpty($config->getValue());
        $this->assertEquals(3, $config->getValue());
    }
}