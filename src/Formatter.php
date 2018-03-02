<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

use Demyan112rv\MountebankPHP\Response\Behavior;

/**
 * Class Formatter
 * @package Demyan112rv\MountebankPHP
 * @since 0.1
 */
class Formatter
{
    /**
     * @var Imposter
     */
    protected $imposter;

    public function __construct(Imposter $imposter)
    {
        $this->imposter = $imposter;
    }

    public function toArray()
    {
        $stubs = [];
        foreach ($this->imposter->getStubs() as $s => $stub) {
            $stubs[$s] = $this->stubToArray($stub);
        }

        $array = [
            'port' => $this->imposter->getPort(),
            'protocol' => $this->imposter->getProtocol(),
            'name' => $this->imposter->getName(),
            'stubs' => $stubs,
            'allowCORS' => $this->imposter->isAllowCORS(),
        ];

        if ($this->imposter->getProtocol() === Imposter::PROTOCOL_HTTPS) {
            $array['key'] = $this->imposter->getKey();
            $array['cert'] = $this->imposter->getCert();
            $array['mutualAuth'] = $this->imposter->isMutualAuth();
        }

        if ($this->imposter->getDefaultResponse()) {
            $array['defaultResponse'] = $this->responseToArray($this->imposter->getDefaultResponse());
        }

        return $array;
    }

    private function stubToArray(Stub $stub): array
    {
        $array = [];
        $responses = [];
        $predicates = [];

        foreach ($stub->getResponses() as $r => $response) {
            $responses[$r] = $this->responseToArray($response);
        }

        foreach ($stub->getPredicates() as $p => $predicate) {
            $predicates[$p] = $this->predicateToArray($predicate);
        }

        $array['responses'] = $responses;
        $array['predicates'] = $predicates;

        return $array;
    }

    private function responseToArray(Response $response): array
    {
        $key = $response->getType();
        $value = $key === Response::TYPE_INJECT ? $response->getInjectJs() : $response->getConfig();
        $array = [$key => $value];

        if ($response->getBehaviors()) {
            $array['_behaviors'] = [];
            foreach ($response->getBehaviors() as $behavior) {
                $array['_behaviors'][$behavior->getType()] = $this->behaviorConfig($behavior);
            }
        }

        return $array;
    }

    private function predicateToArray(Predicate $predicate): array
    {
        $operator = $predicate->getOperator();
        $value = $operator === Predicate::OPERATOR_INJECT ? $predicate->getInjectJs() : $predicate->getConfig();

        $array = [
            $operator => $value,
            'caseSensitive' => $predicate->isCaseSensitive(),
            'except' => $predicate->getExcept(),
        ];

        if ($predicate->getXPath()) {
            $array['xpath'] = [
                'selector' => $predicate->getXPath()->getSelector(),
                'ns' => $predicate->getXPath()->getNs(),
            ];
        }

        if ($predicate->getJsonPath()) {
            $array['jsonpath'] = [
                'selector' => $predicate->getJsonPath()->getSelector()
            ];
        }

        return $array;
    }

    private function behaviorConfig(Behavior $behavior)
    {
        $config = $behavior->getConfig();
        switch (true) {
            case $config instanceof Behavior\Config\Wait:
                $result = $config->getJs() ?? $config->getValue();
                break;
            case $config instanceof Behavior\Config\Repeat:
                $result = $config->getValue();
                break;
            case $config instanceof Behavior\Config\Copy:
                $result = $config->getValues();
                break;
            case $config instanceof Behavior\Config\Lookup:
                $result = $config->getValues();
                break;
            case $config instanceof Behavior\Config\Decorate:
                $result = $config->getJs();
                break;
            case $config instanceof Behavior\Config\ShellTransform:
                $result = $config->getValues();
                break;
            default:
                throw new \InvalidArgumentException('Unknown behavior config class');
        }

        return $result;
    }
}