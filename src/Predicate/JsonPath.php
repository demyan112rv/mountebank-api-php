<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Predicate;

/**
 * Class XPath
 * @package Demyan112rv\MountebankPHP\Predicate
 * @see http://www.mbtest.org/docs/api/jsonpath
 * @since 0.3
 */
class JsonPath
{
    /**
     * The JSONPath selector
     */
    private string $selector;

    public function getSelector(): string
    {
        return $this->selector;
    }

    public function setSelector(string $selector): self
    {
        $this->selector = $selector;
        return $this;
    }
}