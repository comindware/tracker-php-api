<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

use Comindware\Tracker\API\Exception\UnexpectedValueException;
use Comindware\Tracker\API\Model\Workspace;

/**
 * WorkspaceService service.
 *
 * @api
 * @since 0.1
 */
class WorkspaceService extends Service
{
    /**
     * Get all workspaces.
     *
     * @return Workspace[]
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\UnexpectedValueException On invalid response.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
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
                $result[] = new Workspace($item);
            } catch (\InvalidArgumentException $e) {
                throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
            }
        }

        return $result;
    }

    /**
     * Get workspace by id.
     *
     * @param string $id Workspace ID.
     *
     * @return Workspace
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\UnexpectedValueException On invalid response.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since 0.1
     */
    public function get($id)
    {
        $response = $this->client->sendRequest($this->getBase() . '/' . $id);
        if (!is_array($response)) {
            throw new UnexpectedValueException('Array expected, but got ' . gettype($response));
        }

        try {
            return new Workspace($response);
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
        return '/Api/Workspace';
    }
}
