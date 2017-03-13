<?php

namespace Ellllllen\ApiWrapper;

use Illuminate\Contracts\Config\Repository;

class Connect
{
    /**
     * @var ApiClientInterface
     */
    private $apiClient;
    /**
     * @var ReadResponse
     */
    private $readResponse;
    /**
     * @var Repository
     */
    private $config;

    /**
     * Connect constructor.
     * @param ApiClientInterface $apiClient
     * @param ReadResponse $readResponse
     * @param Repository $config
     */
    public function __construct(ApiClientInterface $apiClient, ReadResponse $readResponse, Repository $config)
    {
        $this->apiClient = $apiClient;
        $this->readResponse = $readResponse;
        $this->config = $config;
    }

    public function doGetRequest(array $parameters = []): string
    {
        $queryParameters = $this->apiClient->formatGetParameters($parameters);

        $response = $this->apiClient->get($this->config->get('api-wrapper.base_url'), $this->mergeHeaders($queryParameters));

        return $this->readResponse->getResponseContents($response);
    }

    private function mergeHeaders(array $parameters): array
    {
        $headers['headers'] = $this->config->get('api-wrapper.headers');

        return array_merge($parameters, $headers);
    }

    public function doRequest(string $method, array $parameters = []): string
    {
        $formParameters = $this->apiClient->formatRequestParameters($parameters);

        $response = $this->apiClient->$method($this->config->get('api-wrapper.base_url'), $this->mergeHeaders($formParameters));

        return $this->readResponse->getResponseContents($response);
    }
}