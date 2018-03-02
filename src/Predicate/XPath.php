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
    protected $selector;

    /**
     * The XPath namespace map, aliasing a prefix to a URL,
     * which allows you to use the prefix in the selector.
     * @var array
     */
    protected $ns;

    /**
     * @return string
     */
    public function getSelector(): string
    {
        return $this->selector;
    }

    /**
     * @param string $selector
     * @return XPath
     */
    public function setSelector(string $selector): self
    {
        $this->selector = $selector;
        return $this;
    }

    /**
     * @return array
     */
    public function getNs(): array
    {
        return $this->ns;
    }

    /**
     * @param array $ns
     * @return XPath
     */
    public function setNs(array $ns): self
    {
        $this->ns = $ns;
        return $this;
    }
}