<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Exception;

/**
 * Not authenticated, unknown user name, wrong password or account disabled.
 *
 * @since 0.1
 */
class NotAuthorizedWebApiException extends WebApiClientException
{
}
