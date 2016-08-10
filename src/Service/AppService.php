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
     * @throws \Comindware\Tracker\API\Exception\RuntimeException
     *
     * @since 0.1
     */
    public function getApplications()
    {
        $response = $this->client->sendRequest($this->getBase());
        $result = [];
        if (!is_array($response)) {
            throw new UnexpectedValueException('Array expected, but got ' . gettype($response));
        }
        /** @var array $response */
        foreach ($response as $item) {
            $result[] = new Application($item);
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
     * @throws \Comindware\Tracker\API\Exception\RuntimeException
     *
     * @since 0.1
     */
    public function getApplication($id)
    {
        $response = $this->client->sendRequest($this->getBase() . '/' . $id);
        if (!is_array($response)) {
            throw new UnexpectedValueException('Array expected, but got ' . gettype($response));
        }
        return new Application($response);
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
