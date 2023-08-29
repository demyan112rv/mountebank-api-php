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
    private string $selector;

    /**
     * The XPath namespace map, aliasing a prefix to a URL,
     * which allows you to use the prefix in the selector.
     * @var array<string, string>
     */
    private array $ns = [];

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