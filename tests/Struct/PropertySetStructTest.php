<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Struct;

use Comindware\Tracker\API\Struct\PropertySetStruct;

/**
 * Tests for Comindware\Tracker\API\Struct\PropertySetStruct.
 *
 * @covers Comindware\Tracker\API\Struct\PropertySetStruct
 */
class PropertySetStructTest extends \PHPUnit_Framework_TestCase
{
    public function testExportItems()
    {
        $data = [
            'properties' => [
                [
                    'id' => 'id',
                    'name' => 'ID',
                    'dataType' => 'Instance',
                    'isReadonly' => false,
                    'isCalculated' => false,
                    'isMultivalue' => false,
                    'isSystem' => true,
                    'variants' => []
                ],
                [
                    'id' => 'foo',
                    'name' => 'Foo',
                    'dataType' => 'String',
                    'isReadonly' => false,
                    'isCalculated' => false,
                    'isMultivalue' => false,
                    'isSystem' => false,
                    'variants' => []
                ]
            ],
            'items' => [
                [
                    'id' => ['123'],
                    'foo' => ['Foo bar']
                ],
                [
                    'id' => ['456'],
                    'foo' => ['Bar baz']
                ]
            ]
        ];
        $dataSet = new PropertySetStruct($data);

        static::assertEquals(
            [
                ['id' => '123', 'properties' => ['foo' => 'Foo bar']],
                ['id' => '456', 'properties' => ['foo' => 'Bar baz']]
            ],
            $dataSet->exportItems()
        );
    }
}
