<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Response\Behavior;

use Demyan112rv\MountebankPHP\Response\Behavior\Config\Wait;
use PHPUnit\Framework\TestCase;

class WaitTest extends TestCase
{
    public function testFill()
    {
        $config = new Wait();
        $config->setValue(500);
        $config->setJs('js string');
        $this->assertNotEmpty($config->getValue());
        $this->assertNotEmpty($config->getJs());
        $this->assertEquals(500, $config->getValue());
        $this->assertEquals('js string', $config->getJs());
    }
}