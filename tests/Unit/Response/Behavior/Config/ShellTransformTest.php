<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Response\Behavior;

use Demyan112rv\MountebankPHP\Response\Behavior\Config\ShellTransform;
use PHPUnit\Framework\TestCase;

class ShellTransformTest extends TestCase
{
    public function testFill()
    {
        $config = new ShellTransform();
        $config->setValues([['foo'], ['bar']]);
        $this->assertNotEmpty($config->getValues());
        $this->assertTrue(is_array($config->getValues()));
    }
}