<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

/**
 * Class Imposter
 * @package Demyan112rv\MountebankPHP
 * @since 0.1
 */
class Imposter
{
    const PROTOCOL_HTTP = 'http';
    const PROTOCOL_HTTPS = 'https';
    const PROTOCOL_TCP = 'tcp';
    const PROTOCOL_SMTP = 'smtp';
    const PROTOCOL_GRAPHQL = 'graphql';

    /**
     * The port to run the imposter on.
     * @var int
     */
    protected $port;

    /**
     * Defines the protocol that the imposter will respond to.
     * @var string
     */
    protected $protocol;

    /**
     * Optional. Allows you to provide a descriptive name that will show up in the logs and the imposters UI.
     * @var string
     */
    protected $name;

    /**
     * A set of behaviors used to generate a response for an imposter.
     * An imposter can have 0 or more stubs, each of which are associated with different predicates
     * and support different responses.
     * @var Stub[]
     */
    protected $stubs = [];

    /**
     * The SSL server private key
     * @var string|null
     */
    protected $key;

    /**
     * The SSL server certificate
     * @var string|null
     */
    protected $cert;

    /**
     * If true, the server will request a client certificate.
     * Since the goal is simply to virtualize a server requiring mutual auth,
     * invalid certificates will not be rejected.
     * @var bool
     */
    protected $mutualAuth = false;

    /**
     * The default response to send if no predicate matches.
     * @var Response|null
     */
    protected $defaultResponse;

    /**
     * If true, mountebank will allow all CORS preflight requests on the imposter.
     * @var bool
     */
    protected $allowCORS = false;

    /**
     * If true, mountebank will record requests to enable mock verification
     * @var bool
     */
    protected $recordRequests = false;

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
    public function setPort(int $port): Imposter
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
    public function setProtocol(string $protocol): Imposter
    {
        if (!\in_array($protocol, static::getProtocols())) {
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
    public function setName(string $name): Imposter
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
    public function setStubs(array $stubs): Imposter
    {
        $this->stubs = $stubs;
        return $this;
    }

    /**
     * @param Stub $stub
     * @return Imposter
     */
    public function addStub(Stub $stub): Imposter
    {
        $this->stubs[] = $stub;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param null|string $key
     * @return Imposter
     */
    public function setKey(?string $key): Imposter
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCert(): ?string
    {
        return $this->cert;
    }

    /**
     * @param null|string $cert
     * @return Imposter
     */
    public function setCert(?string $cert): Imposter
    {
        $this->cert = $cert;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMutualAuth(): bool
    {
        return $this->mutualAuth;
    }

    /**
     * @param bool $mutualAuth
     * @return Imposter
     */
    public function setMutualAuth(bool $mutualAuth): Imposter
    {
        $this->mutualAuth = $mutualAuth;
        return $this;
    }

    /**
     * @return Response
     */
    public function getDefaultResponse(): ?Response
    {
        return $this->defaultResponse;
    }

    /**
     * @param Response $defaultResponse
     * @return Imposter
     */
    public function setDefaultResponse(Response $defaultResponse): Imposter
    {
        $this->defaultResponse = $defaultResponse;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAllowCORS(): bool
    {
        return $this->allowCORS;
    }

    /**
     * @param bool $allowCORS
     * @return Imposter
     */
    public function setAllowCORS(bool $allowCORS): Imposter
    {
        $this->allowCORS = $allowCORS;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRecordRequests(): bool
    {
        return $this->recordRequests;
    }

    /**
     * @param bool $recordRequests
     * @return Imposter
     */
    public function setRecordRequests(bool $recordRequests): Imposter
    {
        $this->recordRequests = $recordRequests;
        return $this;
    }
}
