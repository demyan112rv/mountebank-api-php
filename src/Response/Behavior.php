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
    public const TYPE_WAIT = 'wait';
    public const TYPE_REPEAT = 'repeat';
    public const TYPE_COPY = 'copy';
    public const TYPE_LOOKUP = 'lookup';
    public const TYPE_DECORATE = 'decorate';
    public const TYPE_SHELL_TRANSFORM = 'shellTransform';

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

    /**
     * @deprecated
     */
    public function setType(string $type): Behavior
    {

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