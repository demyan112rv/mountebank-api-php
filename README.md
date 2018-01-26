Mountebank API PHP
============


Usage basics
-------------

```php
// Response for stub
$response = new Response(Response::TYPE_IS);
$response->setConfig([
    'statusCode' => 200,
    'headers' => ['Content-Type' => 'application/json'],
    'body' => ['foo' => 'bar']
]);

// Predicate for stub
$predicate = new Predicate(Predicate::OPERATOR_EQUALS);
$predicate->setConfig(['path' => '/test']);

// Stub for imposter
$stub = new Stub();
$stub->addResponse($response)->addPredicate($predicate);

// Imposter for Mountebank
$imposter = new Imposter();
$imposter->setName('Test imposter')
    ->setPort(1234)
    ->setProtocol(Imposter::PROTOCOL_HTTP)
    ->addStub($stub);

// Mountbank config client
$mb = new Mountebank(new \GuzzleHttp\Client());
$mb->setHost('http://localhost')->setPort(2525);

// Add new imposter
$response = $mb->addImposter($imposter);

// remove all imposters
$response = $mb->removeImposters();
```
