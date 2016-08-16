<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

/**
 * Authentication service.
 *
 * TODO Дописать методы.
 *
 * @api
 * @since 0.1
 */
class AuthenticationService extends Service
{
    /**
     * TODO Describe.
     *
     * @param string $token TODO Describe.
     *
     * @return string TODO Describe.
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since 0.1
     */
    public function loginByToken($token)
    {
        return $this->client->sendRequest($this->getBase() . '/LoginByToken/' . $token);
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
        return '/Authentication';
    }
}
