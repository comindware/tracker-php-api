<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Model;

use Comindware\Tracker\API\Model\Item;

/**
 * Tests for Comindware\Tracker\API\Model\Item
 *
 * @covers Comindware\Tracker\API\Model\Item
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test import/export.
     *
     * All data should be imported.
     * All imported properties should be exported.
     */
    public function testImportExport()
    {
        $data = [
            'id' => 'ws.123',
            'name' => 'Foo',
            'description' => 'Bar',
            'containerId' => 'baz.123'
        ];
        $model = new Item();

        $model->import($data);
        static::assertEquals('ws.123', $model->getId());

        static::assertEquals($data, $model->export());
    }

    /**
     * Test item properties.
     *
     * Properties should be exported in a "properties" element.
     */
    public function testProperties()
    {
        $model = new Item();
        $model->set('title', 'Foo');
        static::assertEquals(['properties' => ['title' => ['Foo']]], $model->export());
    }
}
