<?php

namespace Ellllllen\ApiWrapper\ApiClients;

use Ellllllen\ApiWrapper\ApiClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Guzzle implements ApiClientInterface
{
    public function initiate()
    {
        return new Client();
    }

    public function get(string $url, array $options = []): ResponseInterface
    {
        return $this->initiate()->get($url, $options);
    }

    public function delete(string $url, array $options = []): ResponseInterface
    {
        return $this->initiate()->delete($url, $options);
    }

    public function patch(string $url, array $options = []): ResponseInterface
    {
        return $this->initiate()->patch($url, $options);
    }

    public function put(string $url, array $options = []): ResponseInterface
    {
        return $this->initiate()->put($url, $options);
    }

    public function post(string $url, array $options = []): ResponseInterface
    {
        return $this->initiate()->post($url, $options);
    }

    public function formatGetParameters(array $parameters): array
    {
        return ['query' => $parameters];
    }

    public function formatRequestParameters(array $parameters): array
    {
        return ['form_params' => $parameters];
    }
}