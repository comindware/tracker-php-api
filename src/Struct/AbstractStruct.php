<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Struct;

/**
 * Abstract data structure.
 *
 * @since 0.1
 */
abstract class AbstractStruct
{
    /**
     * Structure data.
     *
     * @var array
     */
    private $data = [];

    /**
     * Construct new structure.
     *
     * @param array|null $data Data that should be imported.
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
     * Import data from an array.
     *
     * @param array $data
     *
     * @since 0.1
     */
    public function import(array $data)
    {
        $this->data = $data;
    }

    /**
     * Export data to array.
     *
     * @return array
     *
     * @since 0.1
     */
    public function export()
    {
        return $this->data;
    }

    /**
     * Return structure member.
     *
     * @param string $name    Member name.
     * @param mixed  $default Default value.
     *
     * @return mixed
     *
     * @since 0.1
     */
    protected function getValue($name, $default = null)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return $default;
    }

    /**
     * Set structure member value.
     *
     * @param string $name  Member name.
     * @param mixed  $value Member value.
     *
     * @since 0.1
     */
    protected function setValue($name, $value)
    {
        $this->data[$name] = $value;
    }
}
