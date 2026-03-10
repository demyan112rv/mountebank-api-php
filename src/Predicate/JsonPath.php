<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Predicate;

/**
 * @package Demyan112rv\MountebankPHP\Predicate
 * @see https://www.mbtest.dev/docs/api/jsonpath
 * @since 0.3
 */
class JsonPath
{
    /**
     * The JSONPath selector
     */
    private string $selector;

    public function __construct(string $selector)
    {
        $this->selector = $selector;
    }

    public function getSelector(): string
    {
        return $this->selector;
    }

    /**
     * @deprecated now used __construct()
     */
    public function setSelector(string $selector): self
    {
        $this->selector = $selector;
        return $this;
    }
}