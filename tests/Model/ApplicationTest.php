<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Model;

use Comindware\Tracker\API\Model\Application;

/**
 * Tests for Comindware\Tracker\API\Model\Application
 *
 * @covers Comindware\Tracker\API\Model\Application
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
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
            'description' => 'Bar'
        ];
        $model = new Application();

        $model->import($data);
        static::assertEquals('ws.123', $model->getId());
        static::assertEquals('Foo', $model->getName());
        static::assertEquals('Bar', $model->getDescription());

        static::assertEquals($data, $model->export());
    }
}
