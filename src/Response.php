<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

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
     * Response constructor.
     * @param string|null $type
     */
    public function __construct(string $type = null)
    {
        $this->setType($type);
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
    public function setType(string $type): self
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
     * @return Response
     */
    public function setInjectJs(string $injectJs): self
    {
        $this->injectJs = $injectJs;
        return $this;
    }
}