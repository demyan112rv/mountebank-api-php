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

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $host = 'http://localhost';

    /**
     * @var int
     */
    protected $port = 2525;

    /**
     * Mountebank constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return Mountebank
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
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
     * @return Mountebank
     */
    public function setPort(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getImpostersUrl(): string
    {
        return $this->host . ':' . $this->port . '/' . static::URI_IMPOSTERS;
    }

    /**
     * @return string
     */
    public function getLogsUrl(): string
    {
        return $this->host . ':' . $this->port . '/' . static::URI_LOGS;
    }

    /**
     * @return string
     */
    public function getConfigUrl(): string
    {
        return $this->host . ':' . $this->port . '/' . static::URI_CONFIG;
    }

    /**
     * @codeCoverageIgnore
     * @param int $port
     * @return ResponseInterface
     */
    public function getImposter(int $port): ResponseInterface
    {
        return $this->client->request('GET', $this->getImpostersUrl() . '/' . $port);
    }

    /**
     * @codeCoverageIgnore
     * @return ResponseInterface
     */
    public function getImposters(): ResponseInterface
    {
        return $this->client->request('GET', $this->getImpostersUrl());
    }

    /**
     * @codeCoverageIgnore
     * @param Imposter $imposter
     * @return ResponseInterface
     */
    public function addImposter(Imposter $imposter): ResponseInterface
    {
        $formattedImposter = (new Formatter($imposter))->toArray();
        return $this->client->request('POST', $this->getImpostersUrl(), [
            RequestOptions::BODY => json_encode($formattedImposter),
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
        ]);
    }

    /**
     * @codeCoverageIgnore
     * @param int $port
     * @return ResponseInterface
     */
    public function removeImposter(int $port): ResponseInterface
    {
        return $this->client->request('DELETE', $this->getImpostersUrl() . '/' . $port);
    }

    /**
     * @codeCoverageIgnore
     * @return ResponseInterface
     */
    public function removeImposters(): ResponseInterface
    {
        return $this->client->request('DELETE', $this->getImpostersUrl());
    }

    /**
     * @codeCoverageIgnore
     * @return ResponseInterface
     */
    public function getConfig(): ResponseInterface
    {
        return $this->client->request('GET', $this->getConfigUrl());
    }

    /**
     * @codeCoverageIgnore
     * @return ResponseInterface
     */
    public function getLogs(): ResponseInterface
    {
        return $this->client->request('GET', $this->getLogsUrl());
    }
}