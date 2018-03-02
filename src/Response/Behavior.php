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

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Config
     */
    protected $config;

    /**
     * Behavior constructor.
     * @param string|null $type
     */
    public function __construct(string $type = null)
    {
        if ($type) {
            $this->setType($type);
        }
    }

    /**
     * @return array
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

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Behavior
     */
    public function setType(string $type): Behavior
    {
        if (!in_array($type, static::getTypes())) {
            throw new \InvalidArgumentException();
        }
        $this->type = $type;
        return $this;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Config $config
     * @return Behavior
     */
    public function setConfig(Config $config): Behavior
    {
        $this->config = $config;
        return $this;
    }
}