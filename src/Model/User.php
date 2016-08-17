<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Model;

/**
 * User model.
 *
 * @since 0.1
 */
class User extends Model
{
    /**
     * Return full name.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getFullName()
    {
        return $this->getProperty('fullName');
    }

    /**
     * Set full name.
     *
     * @param string $name
     *
     * @since 0.1
     */
    public function setFullName($name)
    {
        $this->setProperty('fullName', (string) $name);
    }
}
