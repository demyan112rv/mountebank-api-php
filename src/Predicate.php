<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

use Demyan112rv\MountebankPHP\Predicate\JsonPath;
use Demyan112rv\MountebankPHP\Predicate\XPath;

/**
 * Class Predicate
 * @package Demyan112rv\MountebankPHP
 * @see http://www.mbtest.org/docs/api/predicates
 * @since 0.1
 */
class Predicate
{
    public const OPERATOR_EQUALS = 'equals';
    public const OPERATOR_DEEP_EQUALS = 'deepEquals';
    public const OPERATOR_CONTAINS = 'contains';
    public const OPERATOR_START_WITH = 'startsWith';
    public const OPERATOR_END_WITH = 'endsWith';
    public const OPERATOR_MATCHES = 'matches';
    public const OPERATOR_EXISTS = 'exists';
    public const OPERATOR_NOT = 'not';
    public const OPERATOR_OR = 'or';
    public const OPERATOR_AND = 'and';
    public const OPERATOR_INJECT = 'inject';

    private string $operator;

    /**
     * @var array<string, mixed>
     */
    private array $config = [];

    private string $injectJs;

    /**
     * Determines if the match is case sensitive or not.
     * This includes keys for objects such as query parameters.
     */
    private bool $caseSensitive = false;

    /**
     * Defines a regular expression that is stripped out of the request field before matching.
     */
    private string $except = '';

    /**
     * Defines an object containing a selector string and, optionally, an ns object field that defines a namespace map.
     * The predicate's scope is limited to the selected value in the request field.
     */
    private ?XPath $xPath = null;

    /**
     * Defines an object containing a selector string.
     * The predicate's scope is limited to the selected value in the request field.
     */
    private ?JsonPath $jsonPath = null;

    public function __construct(string $operator)
    {
        $this->setOperator($operator);
    }

    /**
     * @return string[]
     */
    public static function getOperators(): array
    {
        return [
            static::OPERATOR_EQUALS,
            static::OPERATOR_DEEP_EQUALS,
            static::OPERATOR_CONTAINS,
            static::OPERATOR_START_WITH,
            static::OPERATOR_END_WITH,
            static::OPERATOR_MATCHES,
            static::OPERATOR_EXISTS,
            static::OPERATOR_NOT,
            static::OPERATOR_OR,
            static::OPERATOR_AND,
            static::OPERATOR_INJECT,
        ];
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @deprecated now used __construct()
     */
    public function setOperator(string $operator): self
    {
        if (!\in_array($operator, static::getOperators())) {
            throw new \InvalidArgumentException();
        }
        $this->operator = $operator;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array<string, mixed> $config
     */
    public function setConfig(array $config): self
    {
        $this->config = $config;
        return $this;
    }

    public function getInjectJs(): string
    {
        return $this->injectJs;
    }

    public function setInjectJs(string $injectJs): self
    {
        $this->injectJs = $injectJs;
        return $this;
    }

    public function isCaseSensitive(): bool
    {
        return $this->caseSensitive;
    }

    public function setCaseSensitive(bool $caseSensitive): self
    {
        $this->caseSensitive = $caseSensitive;
        return $this;
    }

    public function getExcept(): string
    {
        return $this->except;
    }

    public function setExcept(string $except): self
    {
        $this->except = $except;
        return $this;
    }

    public function getXPath(): ?XPath
    {
        return $this->xPath;
    }

    public function setXPath(XPath $xPath): self
    {
        $this->xPath = $xPath;
        return $this;
    }

    public function getJsonPath(): ?JsonPath
    {
        return $this->jsonPath;
    }

    public function setJsonPath(JsonPath $jsonPath): self
    {
        $this->jsonPath = $jsonPath;
        return $this;
    }
}