<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API;

use Comindware\Tracker\API\Exception\RuntimeException;
use Comindware\Tracker\API\Exception\WebApiClientException;
use Comindware\Tracker\API\Util\File\File;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Http\Message\StreamFactory;
use Mekras\ClassHelpers\Traits\LoggingHelperTrait;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

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
    use LoggingHelperTrait;

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
     * HTTP stream factory.
     *
     * @var StreamFactory
     */
    private $streamFactory;

    /**
     * Multipart stream builder.
     *
     * @var MultipartStreamBuilder
     */
    private $multipartStreamBuilder = null;

    /**
     * Create new Tracker API client.
     *
     * @param string         $baseUri        Comindware Tracker root URI.
     * @param string         $token          Authentication token.
     * @param HttpClient     $httpClient     HTTP client.
     * @param MessageFactory $messageFactory HTTP message factory.
     * @param StreamFactory  $streamFactory  HTTP stream factory.
     *
     * @since 0.1
     */
    public function __construct(
        $baseUri,
        $token,
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        StreamFactory $streamFactory
    ) {
        $this->baseUri = rtrim($baseUri, '/');
        $this->token = $token;
        $this->httpClient = $httpClient;
        $this->messageFactory = $messageFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * Send request to Tracker and return response.
     *
     * Payload should an associative array with scalar, array or
     * {@see Comindware\Tracker\API\Util\File\File} values.
     *
     * @param string     $path    Requested URI relative to base URI (e. g. "/Api/Account/123")
     * @param string     $method  HTTP method (e. g. "POST")
     * @param array|null $payload Optional request payload. See method description for details.
     *
     * @return array|string|StreamInterface
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since 0.1
     */
    public function sendRequest($path, $method = 'GET', array $payload = null)
    {
        $this->getLogger()->debug(sprintf('%s %s', $method, $path));

        $request = $this->messageFactory->createRequest(
            $method,
            $this->baseUri . '/' . ltrim($path, '/'),
            ['apiKey' => $this->token]
        );

        if ($payload) {
            $request = $this->buildRequestBody($request, $payload);
            $this->getLogger()->debug(
                sprintf(
                    'Sending payload with "%s" content type',
                    $request->getHeaderLine('Content-type')
                )
            );
        } else {
            $request = $request->withHeader('Content-length', 0);
        }

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (\Exception $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->getStatusCode() !== 200) {
            $message = sprintf(
                'HTTP %d: %s',
                $response->getStatusCode(),
                $response->getReasonPhrase()
            );
            $this->getLogger()->error($message);
            throw new RuntimeException($message);
        }

        $type = explode(';', $response->getHeaderLine('Content-type'));
        $type = reset($type);
        switch ($type) {
            case 'application/json':
                $this->getLogger()->debug('Response body is a JSON');
                return $this->parseJson((string) $response->getBody());
            // break not needed
            case 'application/octet-stream':
                $this->getLogger()->debug('Response body is a stream');

                return $response->getBody();
            // break not needed
        }

        throw new RuntimeException('Unexpected response content type:' . $type);
    }

    /**
     * Build request body from a given payload.
     *
     * @param RequestInterface $request
     * @param array            $payload
     *
     * @return RequestInterface
     * @throws \Comindware\Tracker\API\Exception\RuntimeException
     */
    private function buildRequestBody(RequestInterface $request, array $payload)
    {
        $hasFiles = false;
        foreach ($payload as $value) {
            if ($value instanceof File) {
                $hasFiles = true;
                break;
            }
        }

        if ($hasFiles) {
            $builder = $this->getMultipartStreamBuilder();
            foreach ($payload as $key => $value) {
                if ($value instanceof File) {
                    $builder->addResource(
                        $key,
                        $value->getResource(),
                        ['filename' => $value->getFilename()]
                    );
                } else {
                    $builder->addResource($key, $value);
                }
            }

            try {
                $request = $request
                    ->withHeader(
                        'Content-type',
                        'multipart/form-data; boundary=' . $builder->getBoundary()
                    )
                    ->withBody($builder->build());
            } catch (\Exception $e) {
                throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
            }
        } else {
            try {
                $request = $request
                    ->withHeader('Content-type', 'application/json')
                    ->withBody($this->streamFactory->createStream(json_encode($payload)));
            } catch (\Exception $e) {
                throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
            }
        }

        return $request;
    }

    /**
     * Parse JSON response.
     *
     * @param string $json Server JSON response.
     *
     * @return array|string
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     */
    private function parseJson($json)
    {
        $data = @json_decode($json, true);
        if (null === $data) {
            throw new RuntimeException('JSON parsing failed: ' . json_last_error_msg());
        }

        if (!array_key_exists('response', $data)
            || !array_key_exists('success', $data)
            || !$data['success']
        ) {
            // Default exception.
            $excClass = RuntimeException::class;
            $excMessage = 'Invalid server response: ' . $json;
            if (array_key_exists('error', $data)) {
                $excClass = WebApiClientException::class;
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
            $this->getLogger()->error($excMessage);
            throw new $excClass($excMessage);
        }

        return $data['response'];
    }

    /**
     * Return multipart stream builder.
     *
     * @return MultipartStreamBuilder
     */
    private function getMultipartStreamBuilder()
    {
        if (null === $this->multipartStreamBuilder) {
            $this->multipartStreamBuilder = new MultipartStreamBuilder($this->streamFactory);
        }

        return $this->multipartStreamBuilder;
    }
}
