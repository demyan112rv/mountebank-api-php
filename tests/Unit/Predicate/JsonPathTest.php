<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Predicate;

use Demyan112rv\MountebankPHP\Predicate\JsonPath;
use PHPUnit\Framework\TestCase;

class JsonPathTest extends TestCase
{

    public function testFill(): void
    {
        $jsonPath = new JsonPath('selector');
        $this->assertNotEmpty($jsonPath->getSelector());
        $this->assertEquals('selector', $jsonPath->getSelector());
    }
}