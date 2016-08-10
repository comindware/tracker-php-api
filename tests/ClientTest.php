<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests;

use Comindware\Tracker\API\Client;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Mock\Client as HttpClient;

/**
 * Tests for Comindware\Tracker\API\Client
 *
 * @covers Comindware\Tracker\API\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testSendRequestGet()
    {
        $httpClient = new HttpClient();
        $factory = MessageFactoryDiscovery::find();

        $httpClient->addResponse(
            $factory->createResponse(200, 'OK', [], '{"success":true,"response":{"foo":"bar"}}')
        );

        $client = new Client('http://example.com', 'my.token', $httpClient, $factory);

        $response = $client->sendRequest('Foo/Bar');
        static::assertEquals(['foo' => 'bar'], $response);
    }
}
