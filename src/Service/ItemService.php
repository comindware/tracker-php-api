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
use Comindware\Tracker\API\Model\Transition;
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
     * and properties you want to extract.
     *
     * You should not add "id" to $properties, it will be added automatically.
     *
     * By default items are sorted by ID, you can change this with $orderBy argument.
     *
     * @param string     $expression Expression in Comindware Expression Language.
     * @param array      $properties List of properties to return.
     * @param array|null $orderBy    Sort mode (e. g. ['field' => 'Descending']).
     * @param int|null   $limit      Items to take (100 bu default).
     * @param int        $offset     Items to skip.
     *
     * @return Item[]
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\UnexpectedValueException On invalid response.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     * @throws \LogicException On internal errors.
     *
     * @see   http://kb.comindware.com/comindware-tracker/1.0/comindware-expression-language-how-to/
     * @since 0.3 $orderBy made optional; swapped $orderBy and $properties.
     * @since 0.2
     */
    public function query(
        $expression,
        array $properties,
        array $orderBy = null,
        $limit = null,
        $offset = 0
    ) {
        // Ensure "id" property specified.
        $properties = array_flip($properties);
        $properties['id'] = true;
        $properties = array_keys($properties);

        // Set default ordering if needed.
        if (!$orderBy) {
            $orderBy = ['id' => 'Ascending'];
        }

        // Prepare request payload.
        $payload = [
            'expression' => (string) $expression,
            'sortByColumn' => key($orderBy),
            'sortDirection' => reset($orderBy),
            'properties' => $properties
        ];

        $this->getLogger()->debug('[ItemService::query] Payload: ' . json_encode($payload));

        $url = $this->getBase() . 's/Query?rangeSelector.skip=' . $offset;
        if ($limit) {
            $url .= '&rangeSelector.take=' . $limit;
        }
        $response = $this->client->sendRequest($url, 'POST', $payload);
        try {
            $dataSet = new PropertySetStruct($response);
        } catch (\InvalidArgumentException $e) {
            throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
        }

        $result = [];
        $items = $dataSet->exportItems();
        foreach ($items as $item) {
            try {
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
     * @throws \LogicException On internal errors.
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
     * @throws \LogicException On internal errors.
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
     * Return possible Transitions for Item.
     *
     * @param string $id Item ID.
     *
     * @return Transition[]
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\UnexpectedValueException On invalid response.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     * @throws \LogicException On internal errors.
     *
     * @since 0.3
     */
    public function getTransitions($id)
    {
        $response = $this->client->sendRequest($this->getBase() . '/' . $id . '/Transition');
        $result = [];
        if (!is_array($response)) {
            throw new UnexpectedValueException('Array expected, but got ' . gettype($response));
        }
        /** @var array $response */
        foreach ($response as $item) {
            try {
                $result[] = new Transition($item);
            } catch (\InvalidArgumentException $e) {
                throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
            }
        }

        return $result;
    }

    /**
     * Transit Item to another state.
     *
     * @param string $itemId       Item ID.
     * @param string $transitionId Transition ID.
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\UnexpectedValueException On invalid response.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     * @throws \LogicException On internal errors.
     *
     * @since 0.3
     */
    public function transit($itemId, $transitionId)
    {
        $this->client->sendRequest(
            $this->getBase() . '/' . $itemId . '/Transition/' . $transitionId,
            'POST'
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
