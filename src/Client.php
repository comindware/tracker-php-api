<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API;

use Comindware\Tracker\API\Exception\RuntimeException;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Tracker API client.
 *
 * This is a low-level client for Comindware Tracker API.
 *
 * @api
 * @since 0.1
 */
class Client
{
    /**
     * Comindware Tracker API root URI.
     *
     * @var string
     */
    private $baseUri;

    /**
     * Authentication token.
     *
     * @var string
     */
    private $token;

    /**
     * HTTP client.
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * HTTP message factory.
     *
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * Logger.
     *
     * @var LoggerInterface
     */
    private $logger = null;

    /**
     * Create new Tracker API client.
     *
     * @param string     $baseUri        Comindware Tracker root URI.
     * @param string     $token          Authentication token.
     * @param HttpClient $httpClient     HTTP client.
     * @param            $messageFactory $messageFactory HTTP message factory.
     *
     * @since 0.1
     */
    public function __construct(
        $baseUri,
        $token,
        HttpClient $httpClient,
        MessageFactory $messageFactory
    ) {
        $this->baseUri = rtrim($baseUri, '/');
        $this->token = $token;
        $this->httpClient = $httpClient;
        $this->messageFactory = $messageFactory;
    }

    /**
     * Send request to Tracker and return response.
     *
     * @param string     $path    URI path relative to "/API" (e. g. "/AccountService/{id}")
     * @param string     $method  HTTP method (e. .g "POST")
     * @param array|null $payload Optional request payload.
     *
     * @return array|string
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException Or one of descendants.
     *
     * @since 0.1
     */
    public function sendRequest($path, $method = 'GET', array $payload = null)
    {
        $this->getLogger()->debug(sprintf('%s %s', $method, $path));

        $uri = $this->baseUri . '/' . ltrim($path, '/');
        $headers = ['apiKey' => $this->token, 'Content-type' => 'application/json'];
        $body = $payload ? json_encode($payload) : null;
        $request = $this->messageFactory->createRequest($method, $uri, $headers, $body);

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (\Exception $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException(
                sprintf('HTTP %d: %s', $response->getStatusCode(), $response->getReasonPhrase())
            );
        }

        return $this->parseResponse((string) $response->getBody());
    }

    /**
     * Set logger.
     *
     * @param LoggerInterface $logger
     *
     * @since 0.1
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Parse response.
     *
     * @param string $response HTTP response body.
     *
     * @return array|string
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException
     */
    private function parseResponse($response)
    {
        $data = @json_decode($response, true);
        if (null === $data) {
            throw new RuntimeException('JSON parsing failed: ' . json_last_error_msg());
        }

        if (!array_key_exists('response', $data)
            || !array_key_exists('success', $data)
            || !$data['success']
        ) {
            // Default exception.
            $excClass = RuntimeException::class;
            $excMessage = 'Invalid server response: ' . $response;
            if (array_key_exists('error', $data)) {
                if (array_key_exists('type', $data['error'])) {
                    $className = __NAMESPACE__ . '\\Exception\\' . $data['error']['type'];
                    if (class_exists($className)) {
                        $excClass = $className;
                    }
                }
                if (array_key_exists('message', $data['error'])) {
                    $excMessage = $data['error']['message'];
                }
            }
            throw new $excClass($excMessage);
        }

        return $data['response'];
    }

    /**
     * Return logger.
     *
     * @return LoggerInterface
     */
    private function getLogger()
    {
        if (null === $this->logger) {
            $this->logger = new NullLogger();
        }

        return $this->logger;
    }
}
