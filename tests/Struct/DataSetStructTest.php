<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Struct;

use Comindware\Tracker\API\Struct\DataSetStruct;

/**
 * Tests for Comindware\Tracker\API\Struct\DataSetStruct.
 *
 * @covers Comindware\Tracker\API\Struct\DataSetStruct
 */
class DataSetStructTest extends \PHPUnit_Framework_TestCase
{
    public function testExportItems()
    {
        $data = [
            'columns' => [
                [
                    'datasourceId' => 'id',
                    'dataType' => 'Instance',
                    'name' => 'Identifier',
                    'isMultiValue' => false
                ],
                [
                    'datasourceId' => 'name',
                    'dataType' => 'Undefined',
                    'isMultiValue' => false
                ]
            ],
            'rows' => [
                [
                    'isRead' => false,
                    'data' => [
                        'foo.1',
                        'Foo'
                    ],
                    'isExpired' => false
                ],
                [
                    'isRead' => false,
                    'data' => [
                        'foo.2',
                        'Bar'
                    ],
                    'isExpired' => false
                ],
                [
                    'isRead' => false,
                    'data' => [
                        'foo.3',
                        'Baz'
                    ],
                    'isExpired' => false
                ]
            ]
        ];
        $dataSet = new DataSetStruct($data);

        static::assertEquals(
            [
                ['id' => 'foo.1', 'name' => 'Foo'],
                ['id' => 'foo.2', 'name' => 'Bar'],
                ['id' => 'foo.3', 'name' => 'Baz']
            ],
            $dataSet->exportItems()
        );
    }
}
