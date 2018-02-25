<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit\Predicate;

use Demyan112rv\MountebankPHP\Predicate\XPath;
use PHPUnit\Framework\TestCase;

class XPathTest extends TestCase
{

    public function testFill()
    {
        $xPath = new XPath();
        $xPath->setSelector('selector')->setNs(['foo' => 'bar']);
        $this->assertNotEmpty($xPath->getNs());
        $this->assertNotEmpty($xPath->getSelector());
        $this->assertEquals('selector', $xPath->getSelector());
        $this->assertEquals(['foo' => 'bar'], $xPath->getNs());
    }
}