<?php

declare(strict_types=1);

use Demyan112rv\MountebankPHP\Imposter;
use Demyan112rv\MountebankPHP\Mountebank;
use Demyan112rv\MountebankPHP\Stub;
use Demyan112rv\MountebankPHP\Response;
use Demyan112rv\MountebankPHP\Predicate;

class MountebankTest extends \Codeception\Test\Unit
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

    public function testConfig()
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

        $mb = new Mountebank(new \GuzzleHttp\Client());
        $mb->setHost('http://localhost')->setPort(2525);

        $response = $mb->removeImposters();
        $this->assertTrue($response->getStatusCode() === 200);

        $response = $mb->addImposter($imposter);
        $this->assertTrue($response->getStatusCode() === 201);

        $response = $mb->getImposters();
        $this->assertTrue($response->getStatusCode() === 200);

        $response = $mb->removeImposters();
        $this->assertTrue($response->getStatusCode() === 200);
    }
}