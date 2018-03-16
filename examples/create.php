<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Demyan112rv\MountebankPHP\Imposter;
use Demyan112rv\MountebankPHP\Mountebank;
use Demyan112rv\MountebankPHP\Predicate;
use Demyan112rv\MountebankPHP\Response;
use Demyan112rv\MountebankPHP\Stub;


$stub = new Stub();
$stub->addPredicate(
    (new Predicate(Predicate::OPERATOR_EQUALS))->setConfig([
        'path' => '/test',
        'method' => 'GET'
    ])
)->addResponse(
    (new Response(Response::TYPE_IS))->setConfig([
        'statusCode' => 200,
        'headers' => ['Content-Type' => 'application/json'],
        'body' => ['foo' => 'bar']
    ])
);

$imposter = new Imposter();
$imposter->setName('Test imposter')
    ->setPort(4444)
    ->setProtocol(Imposter::PROTOCOL_HTTP)
    ->addStub($stub);

$mb = new Mountebank(new \GuzzleHttp\Client());
$mb->setHost('http://localhost')->setPort(2525);

$response = $mb->removeImposters();
$response = $mb->addImposter($imposter);
echo $response->getStatusCode() . PHP_EOL; //201

$response = $mb->getImposter(4444);
echo $response->getBody() . PHP_EOL;

$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'http://localhost:4444/test');
echo $response->getBody() . PHP_EOL; // {"foo": "bar"}
