<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Struct;

/**
 * DataSet structure.
 *
 * Not to be confused with the {@see Comindware\Tracker\API\Model\DataSet}!
 *
 * @since 0.1
 */
class DataSetStruct extends AbstractStruct
{
    /**
     * Construct new structure.
     *
     * @param array|null $data Data that should be imported.
     *
     * @throws \InvalidArgumentException If missing any of the required keys.
     *
     * @since 0.1
     */
    public function __construct($data)
    {
        if (!array_key_exists('columns', $data)) {
            throw new \InvalidArgumentException('Missing "columns" key');
        }
        if (!array_key_exists('rows', $data)) {
            throw new \InvalidArgumentException('Missing "rows" key');
        }
        parent::__construct($data);
    }

    /**
     * Return dataset columns.
     *
     * Items are arrays with the following structure:
     *
     * - 'datasourceId': string
     * - 'dataType': string
     * - 'name': string
     * - 'isMultiValue': bool
     *
     * @return array
     *
     * @since 0.1
     */
    public function getColumns()
    {
        return $this->getValue('columns');
    }

    /**
     * Return dataset rows.
     *
     * Items are arrays with the following structure:
     *
     * - 'isRead': bool
     * - 'data': array
     * - 'isExpired': bool
     *
     * @return array
     *
     * @since 0.1
     */
    public function getRows()
    {
        return $this->getValue('rows');
    }

    /**
     * Return all data as an associative arrays.
     *
     * @return array
     *
     * @since 0.1
     */
    public function exportItems()
    {
        $columns = $this->getColumns();
        $rows = $this->getRows();
        $items = [];
        foreach ($rows as $row) {
            $item = [];
            foreach ($row['data'] as $index => $value) {
                $item[$columns[$index]['datasourceId']] = $value;
            }
            $items[] = $item;
        }

        return $items;
    }
}
