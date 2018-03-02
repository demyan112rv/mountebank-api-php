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
    const TYPE_IS = 'is';
    const TYPE_PROXY = 'proxy';
    const TYPE_INJECT = 'inject';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var string
     */
    protected $injectJs;

    /**
     * @var Behavior[]
     */
    protected $behaviors = [];

    /**
     * Response constructor.
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
        return [static::TYPE_IS, static::TYPE_PROXY, static::TYPE_INJECT];
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
     * @return Response
     */
    public function setType(string $type): Response
    {
        if (!in_array($type, static::getTypes())) {
            throw new \InvalidArgumentException();
        }
        $this->type = $type;
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
     * @return Response
     */
    public function setConfig(array $config): Response
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
     * @return Response
     */
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
     * @return Response
     */
    public function setBehaviors(array $behaviors): Response
    {
        $this->behaviors = $behaviors;
        return $this;
    }

    /**
     * @param Behavior $behavior
     * @return Response
     */
    public function addBehavior(Behavior $behavior): Response
    {
        $this->behaviors[] = $behavior;
        return $this;
    }
}