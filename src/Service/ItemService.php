<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

use Comindware\Tracker\API\Exception\UnexpectedValueException;
use Comindware\Tracker\API\Model\Item;

/**
 * Item service.
 *
 * TODO Дописать методы.
 *
 * @api
 * @since 0.1
 */
class ItemService extends Service
{
    /**
     * Get Item.
     *
     * @param string $id Item ID.
     *
     * @return Item
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

        try {
            return new Item($response);
        } catch (\InvalidArgumentException $e) {
            throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Create Item.
     *
     * @param string $containerId Container ID.
     * @param Item   $item        Item model.
     *
     * @return string Created item ID.
     *
     * @throws \InvalidArgumentException If Item has no properties.
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since 0.1
     */
    public function create($containerId, Item $item)
    {
        $properties = $item->export()['properties'];
        if (count($properties) === 0) {
            throw new \InvalidArgumentException('Item should has at least one property!');
        }

        return $this->client->sendRequest(
            $this->getBase() . '/' . $containerId,
            'POST',
            $properties
        );
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
        return '/Api/Item';
    }
}
