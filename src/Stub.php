<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

/**
 * Class Stub
 * @package Demyan112rv\MountebankPHP
 * @see http://www.mbtest.org/docs/api/stubs
 * @since 0.1
 */
class Stub
{
    /**
     * @var Response[]
     */
    private array $responses = [];

    /**
     * @var Predicate[]
     */
    private array $predicates = [];

    /**
     * @return Response[]
     */
    public function getResponses(): array
    {
        return $this->responses;
    }

    /**
     * @param Response[] $responses
     */
    public function setResponses(array $responses): self
    {
        $this->responses = $responses;
        return $this;
    }

    public function addResponse(Response $response): self
    {
        $this->responses[] = $response;
        return $this;
    }

    /**
     * @return Predicate[]
     */
    public function getPredicates(): array
    {
        return $this->predicates;
    }

    /**
     * @param Predicate[] $predicates
     */
    public function setPredicates(array $predicates): self
    {
        $this->predicates = $predicates;
        return $this;
    }

    public function addPredicate(Predicate $predicate): self
    {
        $this->predicates[] = $predicate;
        return $this;
    }
}