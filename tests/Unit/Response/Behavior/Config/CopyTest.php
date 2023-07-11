<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Response\Behavior\Config;

use Demyan112rv\MountebankPHP\Response\Behavior\Config\Copy;
use PHPUnit\Framework\TestCase;

class CopyTest extends TestCase
{
    public function testFill(): void
    {
        $config = new Copy([['foo'], ['bar']]);
        $this->assertNotEmpty($config->getValues());
        $this->assertTrue(is_array($config->getValues()));
    }
}