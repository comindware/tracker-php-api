<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Model;

use Comindware\Tracker\API\Model\Model;

/**
 * Tests for Comindware\Tracker\API\Model\Model
 *
 * @covers Comindware\Tracker\API\Model\Model
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test import/export.
     *
     * All data should be imported.
     * All imported properties should be exported.
     */
    public function testImportExport()
    {
        /** @var Model $model */
        $model = $this->getMockForAbstractClass(Model::class);

        $model->import(['id' => '123', 'foo' => 'bar']);
        static::assertEquals('123', $model->getId());

        $model->setId('foo.123');
        $data = $model->export();
        static::assertEquals(['id' => 'foo.123', 'foo' => 'bar'], $data);
    }
}
