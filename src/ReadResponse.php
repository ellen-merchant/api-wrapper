<?php

namespace Ellllllen\ApiWrapper;

use Psr\Http\Message\ResponseInterface;

class ReadResponse
{
    public function getResponseContents(ResponseInterface $response): string
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception('Response status code is not 200, status code: ' . $response->getStatusCode());
        }

        return $response->getBody()->getContents();
    }
}