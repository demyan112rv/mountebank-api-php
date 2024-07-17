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
     * @return array<string, mixed>
     */
    public function imposterToArray(Imposter $imposter): array
    {
        $stubs = [];
        foreach ($imposter->getStubs() as $s => $stub) {
            $stubs[$s] = $this->stubToArray($stub);
        }

        $array = [
            'port' => $imposter->getPort(),
            'protocol' => $imposter->getProtocol(),
            'name' => $imposter->getName(),
            'stubs' => $stubs,
            'allowCORS' => $imposter->isAllowCORS(),
            'recordRequests' => $imposter->isRecordRequests(),
        ];

        if ($imposter->getProtocol() === Imposter::PROTOCOL_HTTPS) {
            $array['key'] = $imposter->getKey();
            $array['cert'] = $imposter->getCert();
            $array['mutualAuth'] = $imposter->isMutualAuth();
        }

        if ($imposter->getDefaultResponse() !== null) {
            $array['defaultResponse'] = $imposter->getDefaultResponse()->getConfig();
        }

        if ($imposter->getSchema() !== null) {
            $array['schema'] = $imposter->getSchema();
        }

        return $array;
    }

    /**
     * @return array<string, mixed>
     */
    public function stubToArray(Stub $stub): array
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

    /**
     * @return array<string, mixed>
     */
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

    /**
     * @return array<string, mixed>
     */
    private function predicateToArray(Predicate $predicate): array
    {
        $operator = $predicate->getOperator();
        $value = $operator === Predicate::OPERATOR_INJECT ? $predicate->getInjectJs() : $predicate->getConfig();

        $array = [
            $operator => $value,
            'caseSensitive' => $predicate->isCaseSensitive(),
            'except' => $predicate->getExcept(),
        ];

        if ($predicate->getXPath() !== null) {
            $array['xpath'] = [
                'selector' => $predicate->getXPath()->getSelector(),
                'ns' => $predicate->getXPath()->getNs(),
            ];
        }

        if ($predicate->getJsonPath() !== null) {
            $array['jsonpath'] = [
                'selector' => $predicate->getJsonPath()->getSelector()
            ];
        }

        return $array;
    }

    /**
     * @param Behavior $behavior
     * @return array<string, mixed>|int|string|null
     */
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
                $result = $config->getValue();
                break;
            default:
                throw new \InvalidArgumentException('Unknown behavior config class');
        }

        return $result;
    }
}
