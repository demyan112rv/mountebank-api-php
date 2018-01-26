<?php

declare(strict_types=1);

use Demyan112rv\MountebankPHP\Imposter;
use Demyan112rv\MountebankPHP\Stub;
use Demyan112rv\MountebankPHP\Response;
use Demyan112rv\MountebankPHP\Predicate;

class ImposterTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {

    }

    protected function _after()
    {

    }

    public function testFill()
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
        $stub->addResponse($response)->addPredicate($predicate);

        $imposter = new Imposter();
        $imposter->setName('Test imposter')
            ->setPort(1234)
            ->setProtocol(Imposter::PROTOCOL_HTTP)
            ->addStub($stub);

        $stubs = $imposter->getStubs();
        $responses = $stub->getResponses();
        $predicates = $stub->getPredicates();

        $this->assertNotEmpty($imposter->getName());
        $this->assertNotEmpty($imposter->getPort());
        $this->assertNotEmpty($imposter->getProtocol());

        $this->assertTrue(count($stubs) === 1);
        $this->assertTrue($stubs[0] instanceof Stub);

        $this->assertTrue(count($responses) === 1);
        $this->assertTrue($responses[0] instanceof Response);

        $this->assertTrue(count($predicates) === 1);
        $this->assertTrue($predicates[0] instanceof Predicate);
    }
}