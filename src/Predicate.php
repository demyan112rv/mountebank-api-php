<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

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
     * Predicate constructor.
     * @param string|null $operator
     */
    public function __construct(string $operator = null)
    {
        $this->setOperator($operator);
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
}