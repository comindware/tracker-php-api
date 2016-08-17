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
     * @throws \InvalidArgumentException If missing any of the required keys.
     *
     * @since 0.1
     */
    public function import(array $data)
    {
        $this->validate($data, $this->getStructureDefinition());
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
     * Return structure definition.
     *
     * Should return associative array. Keys are treated as a required structure fields. Values can
     * be null (no special meaning) or arrays with the next level constraints.
     *
     * @return array
     *
     * @since 0.1
     */
    protected function getStructureDefinition()
    {
        return [];
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

    /**
     * Validate data according to {@see getStructureDefinition()}.
     *
     * @param array  $data        Data to be validated.
     * @param array  $constraints Constraints.
     * @param string $parentPath  Parent property path.
     *
     * @throws \InvalidArgumentException On any errors.
     */
    private function validate(array $data, array $constraints, $parentPath = '')
    {
        if (is_numeric(key($constraints))) {
            $subConstrains = reset($constraints);
            $length = count($data);
            /** @noinspection ForeachInvariantsInspection */
            for ($i = 0; $i < $length; $i++) {
                $this->validate($data[$i], $subConstrains, $parentPath . '[' . $i . ']');
            }
        } else {
            foreach ($constraints as $key => $subConstrains) {
                if (!array_key_exists($key, $data)) {
                    throw new \InvalidArgumentException(
                        sprintf('Missing key %s[%s]', $parentPath, $key)
                    );
                }
                if ($subConstrains) {
                    $this->validate($data[$key], $subConstrains, $parentPath . '[' . $key . ']');
                }
            }
        }
    }
}
