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
    public function testHttps(): void
    {
        $response = new Response(Response::TYPE_IS);
        $response->setConfig([
                'statusCode' => 200,
                'headers' => ['Content-Type' => 'application/json'],
                'body' => ['foo' => 'bar']
            ])
            ->addBehavior(
                (new Behavior(Behavior::TYPE_WAIT))->setConfig((new Behavior\Config\Wait())->setValue(500))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_WAIT))->setConfig((new Behavior\Config\Wait())->setJs('js'))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_REPEAT))->setConfig((new Behavior\Config\Repeat())->setValue(3))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_COPY))->setConfig((new Behavior\Config\Copy())->setValues([['foo'], ['bar']]))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_LOOKUP))->setConfig((new Behavior\Config\Lookup())->setValues([['foo'], ['bar']]))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_DECORATE))->setConfig((new Behavior\Config\Decorate())->setJs('js'))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_SHELL_TRANSFORM))->setConfig((new Behavior\Config\ShellTransform())->setValues([['foo'], ['bar']]))
            );

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
            ->setDefaultResponse(new Response())
            ->setAllowCORS(true)
            ->setRecordRequests(true);

        $formatter = new Formatter($imposter);
        $array = $formatter->toArray();
        $this->assertNotEmpty($array);
        $this->assertArrayHasKey('port', $array);
        $this->assertArrayHasKey('protocol', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('stubs', $array);
        $this->assertArrayHasKey('allowCORS', $array);
        $this->assertArrayHasKey('recordRequests', $array);
        $this->assertArrayHasKey('key', $array);
        $this->assertArrayHasKey('cert', $array);
        $this->assertArrayHasKey('mutualAuth', $array);
        $this->assertArrayHasKey('defaultResponse', $array);
    }

    public function testHttp(): void
    {
        $response = new Response(Response::TYPE_IS);
        $response->setConfig([
                'statusCode' => 200,
                'headers' => ['Content-Type' => 'application/json'],
                'body' => ['foo' => 'bar']
            ])
            ->addBehavior(
                (new Behavior(Behavior::TYPE_WAIT))->setConfig((new Behavior\Config\Wait())->setValue(500))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_WAIT))->setConfig((new Behavior\Config\Wait())->setJs('js'))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_REPEAT))->setConfig((new Behavior\Config\Repeat())->setValue(3))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_COPY))->setConfig((new Behavior\Config\Copy())->setValues([['foo'], ['bar']]))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_LOOKUP))->setConfig((new Behavior\Config\Lookup())->setValues([['foo'], ['bar']]))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_DECORATE))->setConfig((new Behavior\Config\Decorate())->setJs('js'))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_SHELL_TRANSFORM))->setConfig((new Behavior\Config\ShellTransform())->setValues([['foo'], ['bar']]))
            );

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
            ->setDefaultResponse(new Response())
            ->setAllowCORS(true)
            ->setRecordRequests(true);

        $formatter = new Formatter($imposter);
        $array = $formatter->toArray();
        $this->assertNotEmpty($array);
        $this->assertArrayHasKey('port', $array);
        $this->assertArrayHasKey('protocol', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('stubs', $array);
        $this->assertArrayHasKey('allowCORS', $array);
        $this->assertArrayHasKey('recordRequests', $array);
        $this->assertArrayHasKey('defaultResponse', $array);
    }

    public function testSchemaAttached(): void
    {
        $imposter = new Imposter();
        $imposter->setName('Test imposter')
            ->setPort(1234)
            ->setProtocol(Imposter::PROTOCOL_HTTP)
            ->setSchema('Test Schema');

        $formatter = new Formatter($imposter);
        $array = $formatter->toArray();

        $this->assertArrayHasKey('schema', $array);
    }
}
