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
                (new Behavior(Behavior::TYPE_REPEAT))->setConfig((new Behavior\Config\Repeat(3)))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_COPY))->setConfig((new Behavior\Config\Copy([['foo'], ['bar']])))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_LOOKUP))->setConfig((new Behavior\Config\Lookup([['foo'], ['bar']])))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_DECORATE))->setConfig((new Behavior\Config\Decorate('js')))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_SHELL_TRANSFORM))->setConfig((new Behavior\Config\ShellTransform('shell string')))
            );

        $predicate = new Predicate(Predicate::OPERATOR_EQUALS);
        $predicate->setConfig(['path' => '/test'])
            ->setCaseSensitive(true)
            ->setExcept('expect')
            ->setXPath((new XPath('selector'))->setNs(['foo' => 'bar']))
            ->setJsonPath((new JsonPath('selector')));

        $stub = new Stub();
        $stub->addResponse($response)->addPredicate($predicate);

        $imposter = new Imposter('Test imposter', 1234, Imposter::PROTOCOL_HTTPS);
        $imposter->addStub($stub)
            ->setKey('key')
            ->setCert('cert')
            ->setMutualAuth(true)
            ->setDefaultResponse(new Response(Response::TYPE_IS))
            ->setAllowCORS(true)
            ->setRecordRequests(true);

        $formatter = new Formatter();
        $array = $formatter->imposterToArray($imposter);
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
                (new Behavior(Behavior::TYPE_REPEAT))->setConfig((new Behavior\Config\Repeat(3)))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_COPY))->setConfig((new Behavior\Config\Copy([['foo'], ['bar']])))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_LOOKUP))->setConfig((new Behavior\Config\Lookup([['foo'], ['bar']])))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_DECORATE))->setConfig((new Behavior\Config\Decorate('js')))
            )
            ->addBehavior(
                (new Behavior(Behavior::TYPE_SHELL_TRANSFORM))->setConfig((new Behavior\Config\ShellTransform('shell string')))
            );

        $predicate = new Predicate(Predicate::OPERATOR_EQUALS);
        $predicate->setConfig(['path' => '/test'])
            ->setCaseSensitive(true)
            ->setExcept('expect')
            ->setXPath((new XPath('selector'))->setNs(['foo' => 'bar']))
            ->setJsonPath((new JsonPath('selector')));

        $stub = new Stub();
        $stub->addResponse($response)->addPredicate($predicate);

        $imposter = new Imposter('Test imposter', 1234, Imposter::PROTOCOL_HTTP);
        $imposter->addStub($stub)
            ->setDefaultResponse(new Response(Response::TYPE_IS))
            ->setAllowCORS(true)
            ->setRecordRequests(true);

        $formatter = new Formatter();
        $array = $formatter->imposterToArray($imposter);
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
        $imposter = new Imposter('Test imposter', 1234, Imposter::PROTOCOL_HTTP);
        $imposter->setSchema('Test Schema');

        $formatter = new Formatter();
        $array = $formatter->imposterToArray($imposter);

        $this->assertArrayHasKey('schema', $array);
    }

    public function testPredicateWithPredicates(): void
    {
        $predicate1 = new Predicate(Predicate::OPERATOR_EQUALS);
        $predicate1->setConfig(['path' => '/test1']);

        $predicate2 = new Predicate(Predicate::OPERATOR_START_WITH);
        $predicate2->setConfig(['path' => '/test2']);

        $predicate = new Predicate(Predicate::OPERATOR_AND);
        $predicate->setConfig([
            $predicate1->getOperator() => $predicate1,
            $predicate2->getOperator() => $predicate2,
        ]);

        $stub = new Stub();
        $stub->addPredicate($predicate);

        $imposter = new Imposter('Test imposter', 1234, Imposter::PROTOCOL_HTTPS);
        $imposter->addStub($stub);

        $formatter = new Formatter();
        $array = $formatter->imposterToArray($imposter);
        $this->assertNotEmpty($array);
        $this->assertArrayHasKey('stubs', $array);
        $this->assertArrayHasKey('predicates', $array['stubs'][0]);
        $this->assertSame([
            [
                'and' => [
                    'equals' => [
                        'path' => '/test1',
                    ],
                    'startsWith' => [
                        'path' => '/test2',
                    ],
                ],
                'caseSensitive' => false,
                'except' => '',
            ],
        ], $array['stubs'][0]['predicates']);
    }

    public function testPredicateWithPredicatesAsArray(): void
    {
        $predicate = new Predicate(Predicate::OPERATOR_AND);
        $predicate->setConfig([
            Predicate::OPERATOR_EQUALS => ['path' => '/test1'],
            Predicate::OPERATOR_START_WITH => ['path' => '/test2'],
        ]);

        $stub = new Stub();
        $stub->addPredicate($predicate);

        $imposter = new Imposter('Test imposter', 1234, Imposter::PROTOCOL_HTTPS);
        $imposter->addStub($stub);

        $formatter = new Formatter();
        $array = $formatter->imposterToArray($imposter);
        $this->assertNotEmpty($array);
        $this->assertArrayHasKey('stubs', $array);
        $this->assertArrayHasKey('predicates', $array['stubs'][0]);
        $this->assertSame([
            [
                'and' => [
                    'equals' => [
                        'path' => '/test1',
                    ],
                    'startsWith' => [
                        'path' => '/test2',
                    ],
                ],
                'caseSensitive' => false,
                'except' => '',
            ],
        ], $array['stubs'][0]['predicates']);
    }
}
