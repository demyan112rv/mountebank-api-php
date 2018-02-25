<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;
use Demyan112rv\MountebankPHP\Predicate\JsonPath;
use Demyan112rv\MountebankPHP\Predicate\XPath;

/**
 * Class Predicate
 * @package Demyan112rv\MountebankPHP
 * @see http://www.mbtest.org/docs/api/predicates
 */
class Predicate
{
    const OPERATOR_EQUALS = 'equals';
    const OPERATOR_DEEP_EQUALS = 'deepEquals';
    const OPERATOR_CONTAINS = 'contains';
    const OPERATOR_START_WITH = 'startsWith';
    const OPERATOR_END_WITH = 'endsWith';
    const OPERATOR_MATCHES = 'matches';
    const OPERATOR_EXISTS = 'exists';
    const OPERATOR_NOT = 'not';
    const OPERATOR_OR = 'or';
    const OPERATOR_END = 'end';
    const OPERATOR_INJECT = 'inject';

    /**
     * @var string
     */
    protected $operator;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var string
     */
    protected $injectJs;

    /**
     * Determines if the match is case sensitive or not.
     * This includes keys for objects such as query parameters.
     * @var bool
     */
    protected $caseSensitive = false;

    /**
     * Defines a regular expression that is stripped out of the request field before matching.
     * @var string
     */
    protected $except = '';

    /**
     * Defines an object containing a selector string and, optionally, an ns object field that defines a namespace map.
     * The predicate's scope is limited to the selected value in the request field.
     * @var XPath|null
     */
    protected $xPath;

    /**
     * Defines an object containing a selector string.
     * The predicate's scope is limited to the selected value in the request field.
     * @var JsonPath|null
     */
    protected $jsonPath;

    /**
     * Predicate constructor.
     * @param string|null $operator
     */
    public function __construct(string $operator = null)
    {
        if ($operator) {
            $this->setOperator($operator);
        }
    }

    /**
     * @return array
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
            static::OPERATOR_END,
            static::OPERATOR_INJECT,
        ];
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @param string $operator
     * @return Predicate
     */
    public function setOperator(string $operator): self
    {
        if (!in_array($operator, static::getOperators())) {
            throw new \InvalidArgumentException();
        }
        $this->operator = $operator;
        return $this;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     * @return Predicate
     */
    public function setConfig(array $config): self
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return string
     */
    public function getInjectJs(): string
    {
        return $this->injectJs;
    }

    /**
     * @param string $injectJs
     * @return Predicate
     */
    public function setInjectJs(string $injectJs): self
    {
        $this->injectJs = $injectJs;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCaseSensitive(): bool
    {
        return $this->caseSensitive;
    }

    /**
     * @param bool $caseSensitive
     * @return Predicate
     */
    public function setCaseSensitive(bool $caseSensitive): self
    {
        $this->caseSensitive = $caseSensitive;
        return $this;
    }

    /**
     * @return string
     */
    public function getExcept(): string
    {
        return $this->except;
    }

    /**
     * @param string $except
     * @return Predicate
     */
    public function setExcept(string $except): self
    {
        $this->except = $except;
        return $this;
    }

    /**
     * @return XPath
     */
    public function getXPath(): ?XPath
    {
        return $this->xPath;
    }

    /**
     * @param XPath $xPath
     * @return Predicate
     */
    public function setXPath(XPath $xPath): self
    {
        $this->xPath = $xPath;
        return $this;
    }

    /**
     * @return JsonPath
     */
    public function getJsonPath(): ?JsonPath
    {
        return $this->jsonPath;
    }

    /**
     * @param JsonPath $jsonPath
     * @return Predicate
     */
    public function setJsonPath(JsonPath $jsonPath): self
    {
        $this->jsonPath = $jsonPath;
        return $this;
    }
}