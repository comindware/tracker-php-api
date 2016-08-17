<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Model;

use Comindware\Tracker\API\Model\Account;

/**
 * Tests for Comindware\Tracker\API\Model\Account.
 */
class AccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test workaround for "name" property.
     *
     * Method "GET /Api/Account/{id}" return name in "name" property instead of "fullName".
     */
    public function testNameWorkaround()
    {
        $data = [
            'id' => 'account.123',
            'name' => 'Foo'
        ];
        $account = new Account($data);
        static::assertEquals('Foo', $account->getFullName());
    }
}
