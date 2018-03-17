<?php

namespace Ellllllen\ApiWrapper;

use Illuminate\Contracts\Config\Repository;

class Connect
{
    const BASE_URL = "api-wrapper.base-url";
    const HEADERS = "api-wrapper.headers";
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

    /**
     * Send a request to the api and return the response
     * @param string $method
     * @param array $parameters
     * @return string
     */
    public function doRequest(string $method = "get", array $parameters = []): string
    {
        $queryParameters = $this->getQueryParameters($method, $parameters);

        $response = $this->apiClient->$method($this->config->get(static::BASE_URL),
            $this->mergeHeaders($queryParameters));

        return $this->readResponse->getResponseContents($response);
    }

    /**
     * Merge any headers from the api-wrapper config file with any custom headers for this request
     * @param array $parameters
     * @return array
     */
    private function mergeHeaders(array $parameters): array
    {
        $headers['headers'] = $this->config->get(static::HEADERS);

        return array_merge($parameters, $headers);
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return array
     */
    public function getQueryParameters(string $method, array $parameters): array
    {
        switch ($method) {
            case "get":
                return $this->apiClient->formatGetParameters($parameters);
                break;
            default:
                return $this->apiClient->formatRequestParameters($parameters);
                break;
        }
    }
}