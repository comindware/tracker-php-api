<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Model;

use Comindware\Tracker\API\Model\Workspace;

/**
 * Tests for Comindware\Tracker\API\Model\Workspace
 *
 * @covers Comindware\Tracker\API\Model\Workspace
 */
class WorkspaceTest extends \PHPUnit_Framework_TestCase
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
        $model = new Workspace();

        $model->import($data);
        static::assertEquals('ws.123', $model->getId());
        static::assertEquals('Foo', $model->getName());
        static::assertEquals('Bar', $model->getDescription());
        static::assertEquals('baz.123', $model->getContainerId());

        static::assertEquals($data, $model->export());
    }
}
