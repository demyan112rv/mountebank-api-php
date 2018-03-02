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
    protected $responses = [];

    /**
     * @var Predicate[]
     */
    protected $predicates = [];

    /**
     * @return Response[]
     */
    public function getResponses(): array
    {
        return $this->responses;
    }

    /**
     * @param Response[] $responses
     * @return Stub
     */
    public function setResponses(array $responses): self
    {
        $this->responses = $responses;
        return $this;
    }

    /**
     * @param Response $response
     * @return Stub
     */
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
     * @return Stub
     */
    public function setPredicates(array $predicates): self
    {
        $this->predicates = $predicates;
        return $this;
    }

    /**
     * @param Predicate $predicate
     * @return Stub
     */
    public function addPredicate(Predicate $predicate): self
    {
        $this->predicates[] = $predicate;
        return $this;
    }
}