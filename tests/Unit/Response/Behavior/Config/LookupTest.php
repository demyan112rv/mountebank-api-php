<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Response\Behavior;

use Demyan112rv\MountebankPHP\Response\Behavior\Config\Lookup;
use PHPUnit\Framework\TestCase;

class LookupTest extends TestCase
{
    public function testFill(): void
    {
        $config = new Lookup();
        $config->setValues([['foo'], ['bar']]);
        $this->assertNotEmpty($config->getValues());
        $this->assertTrue(is_array($config->getValues()));
    }
}