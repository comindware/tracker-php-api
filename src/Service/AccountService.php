<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

use Comindware\Tracker\API\Exception\UnexpectedValueException;
use Comindware\Tracker\API\Model\Account;

/**
 * Account service.
 *
 * @api
 * @since 0.1
 */
class AccountService extends Service
{
    /**
     * TODO Describe.
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since 0.1
     */
    public function setAvatar($filename)
    {
        // FIXME
        return $this->client->sendRequest($this->getBase() . '/Avatar', 'POST');
    }

    /**
     * Get all accounts.
     *
     * @return Account[]
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
        if (!array_key_exists('rows', $response)) {
            throw new UnexpectedValueException('Array key "rows" not found');
        }
        foreach ($response['rows'] as $number => $item) {
            if (!array_key_exists('data', $item)) {
                throw new UnexpectedValueException('Array key "data" not found in item ' . $number);
            }
            $result[] = new Account($item['data']);
        }

        return $result;
    }

    /**
     * Get account by ID.
     *
     * @param string $id Account ID.
     *
     * @return Account
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

        return new Account($response);
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
        return '/Api/Account';
    }
}
