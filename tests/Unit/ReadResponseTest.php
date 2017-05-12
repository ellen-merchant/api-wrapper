<?php

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ReadResponseTest extends TestCase
{
    private $testClass;

    public function setUp()
    {
        parent::setUp();

        $this->testClass = new \Ellllllen\ApiWrapper\ReadResponse();
    }

    /**
     * @test
     */
    public function it_reads_the_api_response_contents()
    {
        $status = 200;
        $responseBody = 'api response';

        $result = $this->testClass->getResponseContents(new Response($status, [], $responseBody));

        $this->assertEquals($responseBody, $result);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_status_is_not_ok()
    {
        $status = 301;

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Response status code is not 200, status code: ' . $status);

        $this->testClass->getResponseContents(new Response($status));
    }
}
