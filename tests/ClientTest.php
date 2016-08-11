<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests;

use Comindware\Tracker\API\Client;
use Http\Client\Exception\TransferException;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Mock\Client as HttpClient;

/**
 * Tests for Comindware\Tracker\API\Client
 *
 * @covers Comindware\Tracker\API\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * GET request basic checks.
     */
    public function testSendRequestGet()
    {
        $httpClient = new HttpClient();
        $factory = MessageFactoryDiscovery::find();

        $httpClient->addResponse(
            $factory->createResponse(200, 'OK', [], '{"success":true,"response":{"foo":"bar"}}')
        );

        $client = new Client('http://example.com', 'my.token', $httpClient, $factory);

        $response = $client->sendRequest('Foo/Bar');

        $requests = $httpClient->getRequests();
        static::assertCount(1, $requests);
        $request = $requests[0];
        static::assertEquals('GET', $request->getMethod());
        static::assertEquals(
            [
                'apiKey' => ['my.token'],
                'Host' => ['example.com'],
                'Content-type' => ['application/json']
            ],
            $request->getHeaders()
        );
        static::assertEquals('http://example.com/Foo/Bar', $request->getUri());

        static::assertEquals(['foo' => 'bar'], $response);
    }

    /**
     * POST request basic checks.
     */
    public function testSendRequestPost()
    {
        $httpClient = new HttpClient();
        $factory = MessageFactoryDiscovery::find();

        $httpClient->addResponse(
            $factory->createResponse(200, 'OK', [], '{"success":true,"response":{"foo":"bar"}}')
        );

        $client = new Client('http://example.com', 'my.token', $httpClient, $factory);

        $response = $client->sendRequest('Foo/Bar', 'POST', ['bar' => 'baz']);

        $requests = $httpClient->getRequests();
        static::assertCount(1, $requests);
        $request = $requests[0];
        static::assertEquals('POST', $request->getMethod());
        static::assertEquals(
            [
                'apiKey' => ['my.token'],
                'Host' => ['example.com'],
                'Content-type' => ['application/json']
            ],
            $request->getHeaders()
        );
        static::assertEquals('http://example.com/Foo/Bar', $request->getUri());
        static::assertEquals('{"bar":"baz"}', (string) $request->getBody());

        static::assertEquals(['foo' => 'bar'], $response);
    }

    /**
     * Client::sendRequest() should throw RuntimeException when HTTP response is not "200 OK".
     *
     * @expectedException \Comindware\Tracker\API\Exception\RuntimeException
     * @expectedExceptionMessage Foo bar
     */
    public function testSendRequestHttpClientFailed()
    {
        $httpClient = new HttpClient();
        $factory = MessageFactoryDiscovery::find();

        $httpClient->addException(new TransferException('Foo bar'));
        $client = new Client('http://example.com', 'my.token', $httpClient, $factory);
        $client->sendRequest('Foo');
    }

    /**
     * Client::sendRequest() should throw RuntimeException when HTTP client fails.
     *
     * @expectedException \Comindware\Tracker\API\Exception\RuntimeException
     * @expectedExceptionMessage HTTP 404: Not Found
     */
    public function testSendRequestFailureCode()
    {
        $httpClient = new HttpClient();
        $factory = MessageFactoryDiscovery::find();

        $httpClient->addResponse($factory->createResponse(404, 'Not Found'));
        $client = new Client('http://example.com', 'my.token', $httpClient, $factory);
        $client->sendRequest('Foo');
    }

    /**
     * Client::sendRequest() should throw RuntimeException on receiving invalid JSON.
     *
     * @expectedException \Comindware\Tracker\API\Exception\RuntimeException
     * @expectedExceptionMessage JSON parsing failed: Syntax error
     */
    public function testSendRequestInvalidJson()
    {
        $httpClient = new HttpClient();
        $factory = MessageFactoryDiscovery::find();

        $httpClient->addResponse($factory->createResponse(200, 'OK', [], 'Boo'));
        $client = new Client('http://example.com', 'my.token', $httpClient, $factory);
        $client->sendRequest('Foo');
    }

    /**
     * Client::sendRequest() should throw RuntimeException when required properties not exist.
     *
     * @expectedException \Comindware\Tracker\API\Exception\RuntimeException
     * @expectedExceptionMessage Invalid server response: {"foo":"bar"}
     */
    public function testSendRequestNoRequiredProperties()
    {
        $httpClient = new HttpClient();
        $factory = MessageFactoryDiscovery::find();

        $httpClient->addResponse($factory->createResponse(200, 'OK', [], '{"foo":"bar"}'));
        $client = new Client('http://example.com', 'my.token', $httpClient, $factory);
        $client->sendRequest('Foo');
    }

    /**
     * Client::sendRequest() should throw exception when error reported by server.
     *
     * @expectedException \Comindware\Tracker\API\Exception\WebApiClientException
     * @expectedExceptionMessage Foo bar
     */
    public function testSendRequestException()
    {
        $httpClient = new HttpClient();
        $factory = MessageFactoryDiscovery::find();

        $httpClient->addResponse(
            $factory->createResponse(
                200,
                'OK',
                [],
                '{"success":false,"error":{"type":"WebApiClientException","message":"Foo bar"}}'
            )
        );
        $client = new Client('http://example.com', 'my.token', $httpClient, $factory);
        $client->sendRequest('Foo');
    }
}
