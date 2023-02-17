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
     */
    private int $port;

    /**
     * Defines the protocol that the imposter will respond to.
     */
    private string $protocol;

    /**
     * Optional. Allows you to provide a descriptive name that will show up in the logs and the imposters UI.
     */
    private string $name;

    /**
     * A set of behaviors used to generate a response for an imposter.
     * An imposter can have 0 or more stubs, each of which are associated with different predicates
     * and support different responses.
     * @var Stub[]
     */
    private array $stubs = [];

    /**
     * The SSL server private key
     */
    private ?string $key = null;

    /**
     * The SSL server certificate
     */
    private ?string $cert = null;

    /**
     * If true, the server will request a client certificate.
     * Since the goal is simply to virtualize a server requiring mutual auth,
     * invalid certificates will not be rejected.
     */
    private bool $mutualAuth = false;

    /**
     * The default response to send if no predicate matches.
     */
    private ?Response $defaultResponse = null;

    /**
     * If true, mountebank will allow all CORS preflight requests on the imposter.
     */
    private bool $allowCORS = false;

    /**
     * If true, mountebank will record requests to enable mock verification
     */
    private bool $recordRequests = false;

    /**
     * Only use for support mb-graphl (https://github.com/bashj79/mb-graphql)
     */
    private ?string $schema = null;

    /**
     * @return string[]
     */
    public static function getProtocols(): array
    {
        return [
            static::PROTOCOL_HTTP,
            static::PROTOCOL_HTTPS,
            static::PROTOCOL_TCP,
            static::PROTOCOL_SMTP,
            static::PROTOCOL_GRAPHQL
        ];
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function setPort(int $port): Imposter
    {
        $this->port = $port;
        return $this;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function setProtocol(string $protocol): Imposter
    {
        if (!\in_array($protocol, static::getProtocols())) {
            throw new \InvalidArgumentException();
        }
        $this->protocol = $protocol;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

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
     */
    public function setStubs(array $stubs): Imposter
    {
        $this->stubs = $stubs;
        return $this;
    }

    public function addStub(Stub $stub): Imposter
    {
        $this->stubs[] = $stub;
        return $this;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(?string $key): Imposter
    {
        $this->key = $key;
        return $this;
    }

    public function getCert(): ?string
    {
        return $this->cert;
    }

    public function setCert(?string $cert): Imposter
    {
        $this->cert = $cert;
        return $this;
    }

    public function isMutualAuth(): bool
    {
        return $this->mutualAuth;
    }

    public function setMutualAuth(bool $mutualAuth): Imposter
    {
        $this->mutualAuth = $mutualAuth;
        return $this;
    }

    public function getDefaultResponse(): ?Response
    {
        return $this->defaultResponse;
    }

    public function setDefaultResponse(Response $defaultResponse): Imposter
    {
        $this->defaultResponse = $defaultResponse;
        return $this;
    }

    public function isAllowCORS(): bool
    {
        return $this->allowCORS;
    }

    public function setAllowCORS(bool $allowCORS): Imposter
    {
        $this->allowCORS = $allowCORS;
        return $this;
    }

    public function isRecordRequests(): bool
    {
        return $this->recordRequests;
    }

    public function setRecordRequests(bool $recordRequests): Imposter
    {
        $this->recordRequests = $recordRequests;
        return $this;
    }

    public function getSchema(): ?string
    {
        return $this->schema;
    }

    public function setSchema(?string $schema): Imposter
    {
        $this->schema = $schema;
        return $this;
    }
}
