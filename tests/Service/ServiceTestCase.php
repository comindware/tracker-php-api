<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Service;

use Comindware\Tracker\API\Client;
use Comindware\Tracker\API\Service\Service;
use Psr\Log\NullLogger;

/**
 * Base class for Service tests.
 */
class ServiceTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Create new service instance
     *
     * @param string $serviceClass
     * @param Client|null $client
     *
     * @return Service
     */
    protected function createService($serviceClass, Client $client = null)
    {
        if (null === $client) {
            $client = $this->createClientMock();
        }

        $logger = new NullLogger();

        return new $serviceClass($client, $logger);
    }

    /**
     * Create mock for API client.
     *
     * @param array $map Map for PHPUnit willReturnMap() method.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|Client
     */
    protected function createClientMock(array $map = [])
    {
        $mock = $this->getMockBuilder(Client::class)->disableOriginalConstructor()
            ->setMethods(['sendRequest'])->getMock();
        $mock->expects(static::any())->method('sendRequest')->willReturnMap($map);

        return $mock;
    }
}
