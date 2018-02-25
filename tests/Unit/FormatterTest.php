<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Tests\Unit;

use Demyan112rv\MountebankPHP\Formatter;
use Demyan112rv\MountebankPHP\Imposter;
use Demyan112rv\MountebankPHP\Predicate;
use Demyan112rv\MountebankPHP\Predicate\JsonPath;
use Demyan112rv\MountebankPHP\Predicate\XPath;
use Demyan112rv\MountebankPHP\Response;
use Demyan112rv\MountebankPHP\Response\Behavior;
use Demyan112rv\MountebankPHP\Stub;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase
{
    public function testHttps()
    {
        $response = new Response(Response::TYPE_IS);
        $response->setConfig([
                'statusCode' => 200,
                'headers' => ['Content-Type' => 'application/json'],
                'body' => ['foo' => 'bar']
            ])
            ->addBehavior((new Behavior(Behavior::TYPE_WAIT))->setConfig(500));

        $predicate = new Predicate(Predicate::OPERATOR_EQUALS);
        $predicate->setConfig(['path' => '/test'])
            ->setCaseSensitive(true)
            ->setExcept('expect')
            ->setXPath((new XPath())->setSelector('selector')->setNs(['foo' => 'bar']))
            ->setJsonPath((new JsonPath())->setSelector('selector'));

        $stub = new Stub();
        $stub->addResponse($response)->addPredicate($predicate);

        $imposter = new Imposter();
        $imposter->setName('Test imposter')
            ->setPort(1234)
            ->setProtocol(Imposter::PROTOCOL_HTTPS)
            ->addStub($stub)
            ->setKey('key')
            ->setCert('cert')
            ->setMutualAuth(true)
            ->setDefaultResponse(new Response(Response::TYPE_IS))
            ->setAllowCORS(true);

        $formatter = new Formatter($imposter);
        $array = $formatter->toArray();
        $this->assertNotEmpty($array);
        $this->assertArrayHasKey('port', $array);
        $this->assertArrayHasKey('protocol', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('stubs', $array);
        $this->assertArrayHasKey('allowCORS', $array);
        $this->assertArrayHasKey('key', $array);
        $this->assertArrayHasKey('cert', $array);
        $this->assertArrayHasKey('mutualAuth', $array);
        $this->assertArrayHasKey('defaultResponse', $array);
    }

    public function testHttp()
    {
        $response = new Response(Response::TYPE_IS);
        $response->setConfig([
            'statusCode' => 200,
            'headers' => ['Content-Type' => 'application/json'],
            'body' => ['foo' => 'bar']
        ])
            ->addBehavior((new Behavior(Behavior::TYPE_WAIT))->setConfig(500));

        $predicate = new Predicate(Predicate::OPERATOR_EQUALS);
        $predicate->setConfig(['path' => '/test'])
            ->setCaseSensitive(true)
            ->setExcept('expect')
            ->setXPath((new XPath())->setSelector('selector')->setNs(['foo' => 'bar']))
            ->setJsonPath((new JsonPath())->setSelector('selector'));

        $stub = new Stub();
        $stub->addResponse($response)->addPredicate($predicate);

        $imposter = new Imposter();
        $imposter->setName('Test imposter')
            ->setPort(1234)
            ->setProtocol(Imposter::PROTOCOL_HTTP)
            ->addStub($stub)
            ->setDefaultResponse(new Response(Response::TYPE_IS))
            ->setAllowCORS(true);

        $formatter = new Formatter($imposter);
        $array = $formatter->toArray();
        $this->assertNotEmpty($array);
        $this->assertArrayHasKey('port', $array);
        $this->assertArrayHasKey('protocol', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('stubs', $array);
        $this->assertArrayHasKey('allowCORS', $array);
        $this->assertArrayHasKey('defaultResponse', $array);
    }
}