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
            $responses = [];
            $predicates = [];

            foreach ($stub->getResponses() as $r => $response) {
                $key = $response->getType();
                $value = $key === Response::TYPE_INJECT ? $response->getInjectJs() : $response->getConfig();
                $responses[$r] = [$key => $value];
            }

            foreach ($stub->getPredicates() as $p => $predicate) {
                $key = $predicate->getOperator();
                $value = $key === Predicate::OPERATOR_INJECT ? $predicate->getInjectJs() : $predicate->getConfig();
                $predicates[$p] = [$key => $value];
            }

            $stubs[$s]['responses'] = $responses;
            $stubs[$s]['predicates'] = $predicates;
        }

        return [
            'port' => $this->imposter->getPort(),
            'protocol' => $this->imposter->getProtocol(),
            'name' => $this->imposter->getName(),
            'stubs' => $stubs
        ];
    }
}