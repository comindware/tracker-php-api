<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

use Comindware\Tracker\API\Client;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

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
     * @since 0.1
     */
    protected $client;

    /**
     * Logger.
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Create new API service.
     *
     * @param Client          $client Tracker API client.
     * @param LoggerInterface $logger Logger.
     *
     * @since 0.3 Added $logger argument.
     * @since 0.1
     */
    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * Return base URI path.
     *
     * @return string
     *
     * @since 0.1
     */
    abstract protected function getBase();

    /**
     * Return logger.
     *
     * @return LoggerInterface
     *
     * @since 0.3
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
