<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Model;

/**
 * Transition between to Item states.
 *
 * @since x.x
 */
class Transition extends Model
{
    /**
     * Return name.
     *
     * @return string|null
     *
     * @since x.x
     */
    public function getName()
    {
        return $this->getValue('name');
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @since x.x
     */
    public function setName($name)
    {
        $this->setValue('name', $name);
    }
}
