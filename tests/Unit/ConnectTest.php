<?php

use Ellllllen\ApiWrapper\ApiClientInterface;
use Ellllllen\ApiWrapper\Connect;
use Ellllllen\ApiWrapper\ReadResponse;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\Config\Repository;

class ConnectTest extends TestCase
{
    private $mockApiClientInterface;
    private $testingClass;
    private $mockReadResponse;
    private $mockConfig;

    public function setUp()
    {
        parent::setUp();

        $this->mockApiClientInterface = Mockery::mock(ApiClientInterface::class);
        $this->mockReadResponse = Mockery::mock(ReadResponse::class);
        $this->mockConfig = Mockery::mock(Repository::class);

        $this->testingClass = new Connect($this->mockApiClientInterface, $this->mockReadResponse, $this->mockConfig);
    }

    /**
     * @test
     */
    public function it_does_a_get_request()
    {
        $this->mockApiClientInterface->shouldReceive('formatGetParameters')
            ->with(['parameter' => 123])
            ->once()
            ->andReturn(['query' => ['parameter' => 123]]);

        $this->mockConfig->shouldReceive('get')
            ->with('api-wrapper.base_url')
            ->once()
            ->andReturn('http://api.com');

        $this->mockConfig->shouldReceive('get')
            ->with('api-wrapper.headers')
            ->once()
            ->andReturn(['header1' => 456]);

        $this->mockApiClientInterface->shouldReceive('get')
            ->with('http://api.com', ['query' => ['parameter' => 123], 'headers' => ['header1' => 456]])
            ->once()
            ->andReturn(new Response());

        $this->mockReadResponse->shouldReceive('getResponseContents')
            ->once()
            ->andReturn('response');

        $result = $this->testingClass->doRequest('get', ['parameter' => 123]);

        $this->assertEquals('response', $result);
    }

    /**
     * @test
     */
    public function it_does_a_post_request()
    {
        $this->mockApiClientInterface->shouldReceive('formatRequestParameters')
            ->with(['parameter' => 123])
            ->once()
            ->andReturn(['form_params' => ['parameter' => 123]]);

        $this->mockConfig->shouldReceive('get')
            ->with('api-wrapper.base_url')
            ->once()
            ->andReturn('http://api.com');

        $this->mockConfig->shouldReceive('get')
            ->with('api-wrapper.headers')
            ->once()
            ->andReturn(['header1' => 456]);

        $this->mockApiClientInterface->shouldReceive('post')
            ->with('http://api.com', ['form_params' => ['parameter' => 123], 'headers' => ['header1' => 456]])
            ->once()
            ->andReturn(new Response());

        $this->mockReadResponse->shouldReceive('getResponseContents')
            ->once()
            ->andReturn('response');

        $result = $this->testingClass->doRequest('post', ['parameter' => 123]);

        $this->assertEquals('response', $result);
    }

    /**
     * @test
     */
    public function it_does_a_put_request()
    {
        $this->mockApiClientInterface->shouldReceive('formatRequestParameters')
            ->with(['parameter' => 123])
            ->once()
            ->andReturn(['form_params' => ['parameter' => 123]]);

        $this->mockConfig->shouldReceive('get')
            ->with('api-wrapper.base_url')
            ->once()
            ->andReturn('http://api.com');

        $this->mockConfig->shouldReceive('get')
            ->with('api-wrapper.headers')
            ->once()
            ->andReturn(['header1' => 456]);

        $this->mockApiClientInterface->shouldReceive('put')
            ->with('http://api.com', ['form_params' => ['parameter' => 123], 'headers' => ['header1' => 456]])
            ->once()
            ->andReturn(new Response());

        $this->mockReadResponse->shouldReceive('getResponseContents')
            ->once()
            ->andReturn('response');

        $result = $this->testingClass->doRequest('put', ['parameter' => 123]);

        $this->assertEquals('response', $result);
    }
}
