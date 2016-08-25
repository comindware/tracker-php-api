<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Struct;

/**
 * PropertySet structure.
 *
 * @since 0.2
 */
class PropertySetStruct extends AbstractStruct
{
    /**
     * Return properties.
     *
     * Items are arrays with the following structure:
     *
     * - 'id': string — property identifier
     * - 'name': string — property name
     * - 'description': string, optional — property description
     * - 'dataType': string — property data type
     * - 'isReadonly': boolean, optional — readonly property flag
     * - 'isCalculated': boolean, optional — calculated property flag
     * - 'isMultivalue': boolean, optional — multivalue property flag
     * - 'isSystem': boolean, optional — system property flag
     * - 'expression': string, optional — property expression
     * - 'instanceType': string, optional — property instance type
     * - 'variants': array
     *   - 'id': string
     *   - 'name': string
     *
     * @return array
     *
     * @since 0.2
     */
    public function getProperties()
    {
        return $this->getValue('properties');
    }

    /**
     * Return dataset items.
     *
     * @return array
     *
     * @since 0.2
     */
    public function getItems()
    {
        return $this->getValue('items');
    }

    /**
     * Return all data as an associative arrays.
     *
     * @return array
     *
     * @since 0.3 Custom properties grouped in "properties" element.
     * @since 0.2
     */
    public function exportItems()
    {
        $properties = [];
        foreach ($this->getProperties() as $property) {
            $properties[$property['id']] = $property;
        }

        $result = [];
        $sets = $this->getItems();
        foreach ($sets as $set) {
            $item = ['properties' => []];
            /** @var array $set */
            foreach ($set as $key => $values) {
                $value = reset($values);
                if ($properties[$key]['isSystem']) {
                    $item[$key] = $value;
                } else {
                    $item['properties'][$key] = $value;
                }
            }
            $result[] = $item;
        }

        return $result;
    }

    /**
     * Return structure definition.
     *
     * @return array
     *
     * @since 0.2
     */
    protected function getStructureDefinition()
    {
        return [
            'properties' => [
                [
                    'id' => null,
                    'isSystem' => null
                ]
            ],
            'items' => null
        ];
    }
}
