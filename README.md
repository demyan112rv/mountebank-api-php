Mountebank API PHP
============

[![Latest Stable Version](https://poser.pugx.org/demyan112rv/mountebank-api-php/v/stable)](https://packagist.org/packages/demyan112rv/mountebank-api-php)
[![Total Downloads](https://poser.pugx.org/demyan112rv/mountebank-api-php/downloads)](https://packagist.org/packages/demyan112rv/mountebank-api-php)
[![License](https://poser.pugx.org/demyan112rv/mountebank-api-php/license)](https://packagist.org/packages/demyan112rv/mountebank-api-php)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg)](https://github.com/phpstan/phpstan)
[![Build Status](https://travis-ci.org/demyan112rv/mountebank-api-php.svg?branch=master)](https://travis-ci.org/demyan112rv/mountebank-api-php)
[![Coverage Status](https://coveralls.io/repos/github/demyan112rv/mountebank-api-php/badge.svg?branch=master)](https://coveralls.io/github/demyan112rv/mountebank-api-php?branch=master)

What is the Mountebank? See original [documentation](http://www.mbtest.org/) for understanding.

This package is a php wrapper for [mountebank API](http://www.mbtest.org/docs/api/overview).

## Install

    composer require demyan112rv/mountebank-api-php

## Usage basics


### Response for stub

```php
use Demyan112rv\MountebankPHP\Response;
use Demyan112rv\MountebankPHP\Response\Behavior;
        
$response = new Response(Response::TYPE_IS);
$response->setConfig([
    'statusCode' => 200,
    'headers' => ['Content-Type' => 'application/json'],
    'body' => ['foo' => 'bar']
])->addBehavior(
    (new Behavior())
        ->setType(Behavior::TYPE_WAIT)
        ->setConfig((new Behavior\Config\Wait())->setValue(500))
);
```

### Predicate for stub

```php 
use Demyan112rv\MountebankPHP\Predicate;
use Demyan112rv\MountebankPHP\Predicate\XPath;
use Demyan112rv\MountebankPHP\Predicate\JsonPath;

$predicate = new Predicate(Predicate::OPERATOR_EQUALS);
$predicate->setConfig(['path' => '/test'])
    ->setXPath((new XPath())->setSelector('selector')->setNs(['foo' => 'bar']))
    ->setJsonPath((new JsonPath())->setSelector('selector'));
```

### Stub for imposter

```php
use Demyan112rv\MountebankPHP\Stub;

$stub = new Stub();
$stub->addResponse($response)->addPredicate($predicate);

```
### Imposter for Mountebank

```php
use Demyan112rv\MountebankPHP\Imposter;
use Demyan112rv\MountebankPHP\Mountebank;

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
