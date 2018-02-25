<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Predicate;

/**
 * Class XPath
 * @package Demyan112rv\MountebankPHP\Predicate
 * @see http://www.mbtest.org/docs/api/jsonpath
 */
class JsonPath
{
    /**
     * The JSONPath selector
     * @var string
     */
    protected $selector;

    /**
     * @return string
     */
    public function getSelector(): string
    {
        return $this->selector;
    }

    /**
     * @param string $selector
     * @return JsonPath
     */
    public function setSelector(string $selector): self
    {
        $this->selector = $selector;
        return $this;
    }
}