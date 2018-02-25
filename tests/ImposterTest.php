<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests;

use Demyan112rv\MountebankPHP\Imposter;
use Demyan112rv\MountebankPHP\Stub;
use Demyan112rv\MountebankPHP\Response;
use Demyan112rv\MountebankPHP\Predicate;
use PHPUnit\Framework\TestCase;

class ImposterTest extends TestCase
{

    public function testFill()
    {
        $response = new Response(Response::TYPE_IS);
        $response->setConfig([
            'statusCode' => 200,
            'headers' => ['Content-Type' => 'application/json'],
            'body' => ['foo' => 'bar']
        ]);

        $predicate = new Predicate(Predicate::OPERATOR_EQUALS);
        $predicate->setConfig(['path' => '/test'])
            ->setCaseSensitive(true)
            ->setExcept('expect')
            ->setXPath((new Predicate\XPath())->setSelector('selector')->setNs(['foo' => 'bar']))
            ->setJsonPath((new Predicate\JsonPath())->setSelector('selector'));

        $stub = new Stub();
        $stub->addResponse($response)->addPredicate($predicate);

        $imposter = new Imposter();
        $imposter->setName('Test imposter')
            ->setPort(1234)
            ->setProtocol(Imposter::PROTOCOL_HTTP)
            ->addStub($stub)
            ->setKey('key')
            ->setCert('cert')
            ->setMutualAuth(true)
            ->setDefaultResponse(new Response(Response::TYPE_IS))
            ->setAllowCORS(true);

        $stubs = $imposter->getStubs();
        $responses = $stub->getResponses();
        $predicates = $stub->getPredicates();

        $this->assertNotEmpty($imposter->getName());
        $this->assertNotEmpty($imposter->getPort());
        $this->assertNotEmpty($imposter->getProtocol());
        $this->assertNotEmpty($imposter->getKey());
        $this->assertNotEmpty($imposter->getCert());
        $this->assertTrue($imposter->getDefaultResponse() instanceof Response);
        $this->assertTrue($imposter->isMutualAuth());
        $this->assertTrue($imposter->isAllowCORS());

        $this->assertTrue(count($stubs) === 1);
        $this->assertTrue($stubs[0] instanceof Stub);

        $this->assertTrue(count($responses) === 1);
        $this->assertTrue($responses[0] instanceof Response);

        $this->assertTrue(count($predicates) === 1);
        $this->assertTrue($predicates[0] instanceof Predicate);
        $this->assertTrue($predicates[0]->isCaseSensitive());
        $this->assertNotEmpty($predicates[0]->getExcept());

        $this->assertTrue($predicates[0]->getXPath() instanceof Predicate\XPath);
        $this->assertNotEmpty($predicates[0]->getXPath()->getSelector());
        $this->assertNotEmpty($predicates[0]->getXPath()->getNs());

        $this->assertTrue($predicates[0]->getJsonPath() instanceof Predicate\JsonPath);
        $this->assertNotEmpty($predicates[0]->getJsonPath()->getSelector());
    }
}