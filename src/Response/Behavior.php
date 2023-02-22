<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Response;

use Demyan112rv\MountebankPHP\Response\Behavior\Config;

/**
 * Class Behavior
 * @package Demyan112rv\MountebankPHP\Response
 * @see http://www.mbtest.org/docs/api/behaviors
 * @since 0.5
 */
class Behavior
{
    const TYPE_WAIT = 'wait';
    const TYPE_REPEAT = 'repeat';
    const TYPE_COPY = 'copy';
    const TYPE_LOOKUP = 'lookup';
    const TYPE_DECORATE = 'decorate';
    const TYPE_SHELL_TRANSFORM = 'shellTransform';

    private string $type;

    private Config $config;

    public function __construct(string $type)
    {
        $this->setType($type);
    }

    /**
     * @return string[]
     */
    public static function getTypes(): array
    {
        return [
            static::TYPE_WAIT,
            static::TYPE_REPEAT,
            static::TYPE_COPY,
            static::TYPE_LOOKUP,
            static::TYPE_DECORATE,
            static::TYPE_SHELL_TRANSFORM,
        ];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Behavior
    {
        if (!\in_array($type, static::getTypes())) {
            throw new \InvalidArgumentException();
        }
        $this->type = $type;
        return $this;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function setConfig(Config $config): Behavior
    {
        $this->config = $config;
        return $this;
    }
}