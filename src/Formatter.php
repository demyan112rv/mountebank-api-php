<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

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

        return [
            'port' => $this->imposter->getPort(),
            'protocol' => $this->imposter->getProtocol(),
            'name' => $this->imposter->getName(),
            'stubs' => $stubs
        ];
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
        return [$key => $value];
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
}