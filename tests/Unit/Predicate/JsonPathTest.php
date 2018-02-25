<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Predicate;

use Demyan112rv\MountebankPHP\Predicate\JsonPath;
use PHPUnit\Framework\TestCase;

class JsonPathTest extends TestCase
{

    public function testFill()
    {
        $jsonPath = new JsonPath();
        $jsonPath->setSelector('selector');
        $this->assertNotEmpty($jsonPath->getSelector());
        $this->assertEquals('selector', $jsonPath->getSelector());
    }
}