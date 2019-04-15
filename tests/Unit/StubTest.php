<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit;

use Demyan112rv\MountebankPHP\Stub;
use Demyan112rv\MountebankPHP\Response;
use Demyan112rv\MountebankPHP\Predicate;
use PHPUnit\Framework\TestCase;

class StubTest extends TestCase
{
    public function testFill(): void
    {
        $response = new Response(Response::TYPE_IS);
        $response->setConfig([
            'statusCode' => 200,
            'headers' => ['Content-Type' => 'application/json'],
            'body' => ['foo' => 'bar']
        ]);

        $predicate = new Predicate(Predicate::OPERATOR_EQUALS);
        $predicate->setConfig(['path' => '/test']);

        $stub = new Stub();
        $stub->setPredicates([$predicate])->setResponses([$response]);

        $this->assertNotEmpty($stub->getPredicates());
        $this->assertNotEmpty($stub->getResponses());
        $this->assertCount(1, $stub->getPredicates());
        $this->assertCount(1, $stub->getResponses());

        $stub->addResponse($response)->addPredicate($predicate);

        $this->assertCount(2, $stub->getPredicates());
        $this->assertCount(2, $stub->getResponses());

    }
}