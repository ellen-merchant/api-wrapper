<?php

namespace Ellllllen\ApiWrapper;

use Psr\Http\Message\ResponseInterface;

interface ApiClientInterface
{
    public function get(string $url, array $options = []): ResponseInterface;

    public function delete(string $url, array $options = []): ResponseInterface;

    public function patch(string $url, array $options = []): ResponseInterface;

    public function put(string $url, array $options = []): ResponseInterface;

    public function post(string $url, array $options = []): ResponseInterface;

    public function formatGetParameters(array $parameters): array;

    public function formatRequestParameters(array $parameters): array;
}