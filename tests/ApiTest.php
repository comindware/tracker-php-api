<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests;

use Comindware\Tracker\API\Api;
use Comindware\Tracker\API\Client;
use Comindware\Tracker\API\Service\AttachmentService;

/**
 * Tests for Comindware\Tracker\API\Api
 *
 * @covers Comindware\Tracker\API\Api
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Api::getClient() should return a used Client.
     */
    public function testGetClient()
    {
        /** @var Client $client */
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $api = new Api($client);

        static::assertSame($client, $api->getClient());
    }

    /**
     * Api::attachment() should return an instance of AttachmentService.
     */
    public function testAttachment()
    {
        /** @var Client $client */
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $api = new Api($client);

        static::assertInstanceOf(AttachmentService::class, $api->attachment());
    }
}
