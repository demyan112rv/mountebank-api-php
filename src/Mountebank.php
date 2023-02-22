<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Mountebank
 * @package Demyan112rv\MountebankPHP
 * @since 0.1
 */
class Mountebank
{
    const URI_IMPOSTERS = 'imposters';
    const URI_CONFIG = 'config';
    const URI_LOGS = 'logs';

    private ClientInterface $client;

    private string $host;

    private int $port;

    public function __construct(
        ClientInterface $client,
        string $host = 'http://localhost',
        int $port = 2525
    ) {
        $this->client = $client;
        $this->host = $host;
        $this->port = $port;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @deprecated
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @deprecated
     */
    public function setPort(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    public function getImpostersUrl(): string
    {
        return $this->host . ':' . $this->port . '/' . static::URI_IMPOSTERS;
    }

    public function getLogsUrl(): string
    {
        return $this->host . ':' . $this->port . '/' . static::URI_LOGS;
    }

    public function getConfigUrl(): string
    {
        return $this->host . ':' . $this->port . '/' . static::URI_CONFIG;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getImposter(int $port): ResponseInterface
    {
        return $this->client->request('GET', $this->getImpostersUrl() . '/' . $port);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getImposters(): ResponseInterface
    {
        return $this->client->request('GET', $this->getImpostersUrl());
    }

    /**
     * @codeCoverageIgnore
     */
    public function addImposter(Imposter $imposter): ResponseInterface
    {
        $formattedImposter = (new Formatter($imposter))->toArray();
        return $this->client->request('POST', $this->getImpostersUrl(), [
            RequestOptions::BODY => \json_encode($formattedImposter),
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
        ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function removeImposter(int $port): ResponseInterface
    {
        return $this->client->request('DELETE', $this->getImpostersUrl() . '/' . $port);
    }

    /**
     * @codeCoverageIgnore
     */
    public function removeImposters(): ResponseInterface
    {
        return $this->client->request('DELETE', $this->getImpostersUrl());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getConfig(): ResponseInterface
    {
        return $this->client->request('GET', $this->getConfigUrl());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getLogs(): ResponseInterface
    {
        return $this->client->request('GET', $this->getLogsUrl());
    }
}