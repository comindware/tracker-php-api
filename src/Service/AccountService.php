<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

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
     * TODO Describe.
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since 0.1
     */
    public function getAccounts()
    {
        // FIXME
        return $this->client->sendRequest($this->getBase());
    }

    /**
     * TODO Describe.
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since 0.1
     */
    public function getAccount($id)
    {
        // FIXME
        return $this->client->sendRequest($this->getBase() . '/' . $id);
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
