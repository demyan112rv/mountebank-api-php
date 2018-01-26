<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

class Imposter
{
    const PROTOCOL_HTTP = 'http';
    const PROTOCOL_HTTPS = 'https';
    const PROTOCOL_TCP = 'tcp';
    const PROTOCOL_SMTP = 'smtp';

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $protocol;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Stub[]
     */
    protected $stubs = [];

    /**
     * @return array
     */
    public static function getProtocols(): array
    {
        return [static::PROTOCOL_HTTP, static::PROTOCOL_HTTPS, static::PROTOCOL_TCP, static::PROTOCOL_SMTP];
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return Imposter
     */
    public function setPort(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     * @return Imposter
     */
    public function setProtocol(string $protocol): self
    {
        if (!in_array($protocol, static::getProtocols())) {
            throw new \InvalidArgumentException();
        }
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Imposter
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Stub[]
     */
    public function getStubs(): array
    {
        return $this->stubs;
    }

    /**
     * @param Stub[] $stubs
     * @return Imposter
     */
    public function setStubs(array $stubs): self
    {
        $this->stubs = $stubs;
        return $this;
    }

    /**
     * @param Stub $stub
     * @return Imposter
     */
    public function addStub(Stub $stub): self
    {
        $this->stubs[] = $stub;
        return $this;
    }
}