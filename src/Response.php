<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

use Demyan112rv\MountebankPHP\Response\Behavior;

/**
 * Class Response
 * @package Demyan112rv\MountebankPHP
 * @since 0.1
 */
class Response
{
    public const TYPE_IS = 'is';
    public const TYPE_PROXY = 'proxy';
    public const TYPE_INJECT = 'inject';

    /**
     * @var string
     */
    private string $type;

    /**
     * @var array<string, mixed>
     */
    private array $config = [];

    /**
     * @var string
     */
    private string $injectJs;

    /**
     * @var Behavior[]
     */
    private array $behaviors = [];

    public function __construct(string $type)
    {
        $this->setType($type);
    }

    /**
     * @return string[]
     */
    public static function getTypes(): array
    {
        return [static::TYPE_IS, static::TYPE_PROXY, static::TYPE_INJECT];
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @deprecated now used __construct()
     */
    public function setType(string $type): Response
    {
        if (!\in_array($type, static::getTypes())) {
            throw new \InvalidArgumentException();
        }
        $this->type = $type;
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
    public function setConfig(array $config): Response
    {
        $this->config = $config;
        return $this;
    }

    public function getInjectJs(): string
    {
        return $this->injectJs;
    }

    public function setInjectJs(string $injectJs): Response
    {
        $this->injectJs = $injectJs;
        return $this;
    }

    /**
     * @return Behavior[]
     */
    public function getBehaviors(): array
    {
        return $this->behaviors;
    }

    /**
     * @param Behavior[] $behaviors
     */
    public function setBehaviors(array $behaviors): Response
    {
        $this->behaviors = $behaviors;
        return $this;
    }

    public function addBehavior(Behavior $behavior): Response
    {
        $this->behaviors[] = $behavior;
        return $this;
    }
}