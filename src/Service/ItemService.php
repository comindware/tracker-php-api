<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

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
     * Create Item.
     *
     * @param string $id         Container ID.
     * @param array  $properties Item properties.
     *
     * @return string Created item ID.
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException
     *
     * @since 0.1
     */
    public function createItem($id, array $properties)
    {
        return $this->client->sendRequest($this->getBase() . '/' . $id, 'POST', $properties);
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
