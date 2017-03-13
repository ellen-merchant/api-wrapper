<?php

namespace Ellllllen\ApiWrapper;

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
     * Connect constructor.
     * @param ApiClientInterface $apiClient
     * @param ReadResponse $readResponse
     */
    public function __construct(ApiClientInterface $apiClient, ReadResponse $readResponse)
    {
        $this->apiClient = $apiClient;
        $this->readResponse = $readResponse;
    }

    public function doGetRequest(array $parameters = []): string
    {
        $queryParameters = $this->apiClient->formatGetParameters($parameters);

        $response = $this->apiClient->get(config('api-wrapper.base_url'), $this->mergeHeaders($queryParameters));

        return $this->readResponse->getResponseContents($response);
    }

    private function mergeHeaders(array $parameters): array
    {
        $headers['headers'] = config('api-wrapper.headers');

        return array_merge($parameters, $headers);
    }

    public function doRequest(string $method, array $parameters = []): string
    {
        $formParameters = $this->apiClient->formatRequestParameters($parameters);

        $response = $this->apiClient->$method(config('api-wrapper.base_url'), $this->mergeHeaders($formParameters));

        return $this->readResponse->getResponseContents($response);
    }
}