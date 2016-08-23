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
use Comindware\Tracker\API\Struct\PropertySetStruct;

/**
 * Item service.
 *
 * @api
 * @since 0.1
 */
class ItemService extends Service
{
    /**
     * Get items with a custom query.
     *
     * You can get items in your work environment with a custom query by providing an expression
     * and
     * properties you want to extract.
     *
     * Additionally you can specify property and direction for sorting if you want the items to be
     * sorted in a particular way.
     *
     * @param string   $expression Expression in Comindware Expression Language.
     * @param array    $orderBy    Sort mode (e. g. ['field' => 'Descending']).
     * @param array    $properties List of properties to return.
     * @param int|null $limit      Items to take (100 bu default).
     * @param int      $offset     Items to skip.
     *
     * @return Item[]
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\UnexpectedValueException On invalid response.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @see   http://kb.comindware.com/comindware-tracker/1.0/comindware-expression-language-how-to/
     * @since 0.2
     */
    public function query($expression, $orderBy, array $properties, $limit = null, $offset = 0)
    {
        $params = [
            'expression' => (string) $expression,
            'sortByColumn' => key($orderBy),
            'sortDirection' => reset($orderBy),
            'properties' => $properties
        ];

        $url = $this->getBase() . 's/Query?rangeSelector.skip=' . $offset;
        if ($limit) {
            $url .= '&rangeSelector.take=' . $limit;
        }
        $response = $this->client->sendRequest($url, 'POST', $params);
        try {
            $dataSet = new PropertySetStruct($response);
        } catch (\InvalidArgumentException $e) {
            throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
        }

        $result = [];
        $items = $dataSet->exportItems();
        foreach ($items as $item) {
            try {
                /*
                 * API methods are inconsistent. This one returns both regular and custom item
                 * properties in a single set. So we need this ugly hack to fill Item class
                 * properly.
                 */
                $item['properties'] = $item;
                $result[] = new Item($item);
            } catch (\InvalidArgumentException $e) {
                throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
            }
        }

        return $result;
    }

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
