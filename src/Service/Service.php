<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

use Comindware\Tracker\API\Client;

/**
 * Abstract API service (group of methods).
 *
 * @since 0.1
 */
abstract class Service
{
    /**
     * Tracker client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Create new API service.
     *
     * @param Client $client Tracker API client.
     *
     * @since 0.1
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Return base URI path.
     *
     * @return string
     *
     * @since 0.1
     */
    abstract protected function getBase();
}
