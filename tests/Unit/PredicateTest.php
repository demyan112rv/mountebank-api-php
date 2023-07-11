<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit;

use Demyan112rv\MountebankPHP\Predicate;
use Demyan112rv\MountebankPHP\Predicate\XPath;
use Demyan112rv\MountebankPHP\Predicate\JsonPath;
use PHPUnit\Framework\TestCase;

class PredicateTest extends TestCase
{
    public function testFill(): void
    {
        $predicate = new Predicate(Predicate::OPERATOR_EQUALS);
        $predicate->setConfig(['path' => '/test'])
            ->setInjectJs('Inject js string')
            ->setCaseSensitive(true)
            ->setExcept('expect')
            ->setXPath((new XPath())->setSelector('selector')->setNs(['foo' => 'bar']))
            ->setJsonPath((new JsonPath('selector')));

        $this->assertNotEmpty($predicate->getOperator());
        $this->assertNotEmpty($predicate->getConfig());
        $this->assertNotEmpty($predicate->getInjectJs());
        $this->assertNotEmpty($predicate->getExcept());
        $this->assertTrue($predicate->isCaseSensitive());
        $this->assertTrue($predicate->getXPath() instanceof XPath);
        $this->assertTrue($predicate->getJsonPath() instanceof JsonPath);

    }

    public function testWrongType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Predicate('Wrong operator');
    }
}