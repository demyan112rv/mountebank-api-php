<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Predicate;

/**
 * Class XPath
 * @package Demyan112rv\MountebankPHP\Predicate
 * @see http://www.mbtest.org/docs/api/xpath
 * @since 0.3
 */
class XPath
{
    /**
     * The XPath selector
     * @var string
     */
    protected string $selector;

    /**
     * The XPath namespace map, aliasing a prefix to a URL,
     * which allows you to use the prefix in the selector.
     * @var array<string, string>
     */
    protected array $ns;

    public function getSelector(): string
    {
        return $this->selector;
    }

    public function setSelector(string $selector): self
    {
        $this->selector = $selector;
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getNs(): array
    {
        return $this->ns;
    }

    /**
     * @param array<string, string> $ns
     */
    public function setNs(array $ns): self
    {
        $this->ns = $ns;
        return $this;
    }
}