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
use Comindware\Tracker\API\Struct\DataSetStruct;
use Comindware\Tracker\API\Struct\FileStruct;

/**
 * Account service.
 *
 * @api
 * @since 0.1
 */
class AccountService extends Service
{
    /**
     * Get avatars.
     *
     * @param array $accounts Array of {@see \Comindware\Tracker\API\Model\Account} or IDs.
     *
     * @return FileStruct[]
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\UnexpectedValueException On invalid response.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since 0.1
     */
    public function getAvatars(array $accounts)
    {
        $ids = [];
        foreach ($accounts as $account) {
            if ($account instanceof Account) {
                $ids[] = $account->getId();
            } else {
                $ids[] = $account;
            }
        }

        $response = $this->client->sendRequest(
            $this->getBase() . '/Avatar',
            'POST',
            $ids
        );
        if (!is_array($response)) {
            throw new UnexpectedValueException('Array expected, but got ' . gettype($response));
        }

        $result = [];
        /** @var array $response */
        foreach ($response as $item) {
            try {
                $result[] = new FileStruct($item);
            } catch (\InvalidArgumentException $e) {
                throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
            }
        }

        return $result;
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
        try {
            $dataSet = new DataSetStruct($response);
        } catch (\InvalidArgumentException $e) {
            throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
        }

        $result = [];
        $items = $dataSet->exportItems();
        foreach ($items as $item) {
            try {
                $result[] = new Account($item);
            } catch (\InvalidArgumentException $e) {
                throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
            }
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

        try {
            return new Account($response);
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
        return '/Api/Account';
    }
}
