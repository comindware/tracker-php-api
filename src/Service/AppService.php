<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

use Comindware\Tracker\API\Exception\UnexpectedValueException;
use Comindware\Tracker\API\Model\Application;

/**
 * App service.
 *
 * @api
 * @since 0.1
 */
class AppService extends Service
{
    /**
     * Get list of all applications.
     *
     * @return Application[]
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\UnexpectedValueException On invalid response.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since x.x renamed from "getApplications" to "getAll".
     * @since 0.1
     */
    public function getAll()
    {
        $response = $this->client->sendRequest($this->getBase());
        $result = [];
        if (!is_array($response)) {
            throw new UnexpectedValueException('Array expected, but got ' . gettype($response));
        }
        /** @var array $response */
        foreach ($response as $item) {
            try {
                $result[] = new Application($item);
            } catch (\InvalidArgumentException $e) {
                throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
            }
        }

        return $result;
    }

    /**
     * Get application by id.
     *
     * @param string $id Application ID.
     *
     * @return Application
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\UnexpectedValueException On invalid response.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since x.x renamed from "getApplication" to "get".
     * @since 0.1
     */
    public function get($id)
    {
        $response = $this->client->sendRequest($this->getBase() . '/' . $id);
        if (!is_array($response)) {
            throw new UnexpectedValueException('Array expected, but got ' . gettype($response));
        }

        try {
            return new Application($response);
        } catch (\InvalidArgumentException $e) {
            throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Return base URI path.
     *
     * @return string
     *
     * @since 0.1
     */
    protected function getBase()
    {
        return '/Api/App';
    }
}
