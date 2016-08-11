<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Model;

use Mekras\ClassHelpers\Traits\GettersCacheTrait;

/**
 * Abstract API data model.
 *
 * @since 0.1
 */
abstract class Model
{
    use GettersCacheTrait;

    /**
     * Model properties.
     *
     * @var array
     */
    private $properties = [];

    /**
     * Construct new model.
     *
     * @param array|null $data Data that should be imported into model.
     *
     * @since 0.1
     */
    public function __construct(array $data = null)
    {
        if (null !== $data) {
            $this->import($data);
        }
    }

    /**
     * Return model ID.
     *
     * @return string
     *
     * @since 0.1
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Set model ID.
     *
     * @param string $id
     *
     * @since 0.1
     */
    public function setId($id)
    {
        $this->setProperty('id', (string) $id);
    }

    /**
     * Import data from an array.
     *
     * @param array $data
     *
     * @since 0.1
     */
    public function import(array $data)
    {
        $this->properties = $data;
        $this->dropCachedProperties();
    }

    /**
     * Export model data to array.
     *
     * @return array
     *
     * @since 0.1
     */
    public function export()
    {
        return $this->properties;
    }

    /**
     * Return model property.
     *
     * @param string $property Property name.
     * @param mixed  $default  Default property value.
     *
     * @return mixed
     *
     * @since 0.1
     */
    protected function getProperty($property, $default = null)
    {
        if (array_key_exists($property, $this->properties)) {
            return $this->properties[$property];
        }

        return $default;
    }

    /**
     * Set model property value.
     *
     * @param string $property Property name.
     * @param mixed  $value    Property value.
     *
     * @since 0.1
     */
    protected function setProperty($property, $value)
    {
        $this->properties[$property] = $value;
    }
}
