<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Response\Behavior;

use Demyan112rv\MountebankPHP\Response\Behavior\Config\ShellTransform;
use PHPUnit\Framework\TestCase;

class ShellTransformTest extends TestCase
{
    public function testFill(): void
    {
        $config = new ShellTransform();
        $config->setValues('shell string');
        $this->assertNotEmpty($config->getValue());
        $this->assertSame('shell string', $config->getValue());
    }
}