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
 * @since 0.3
 */
class Transition extends Model
{
    /**
     * Return name.
     *
     * @return string|null
     *
     * @since 0.3
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
     * @since 0.3
     */
    public function setName($name)
    {
        $this->setValue('name', $name);
    }
}
