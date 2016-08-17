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
 * Tests for Comindware\Tracker\API\Model\Model.
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test get/set Id.
     */
    public function testGetSetId()
    {
        /** @var Model $model */
        $model = $this->getMockForAbstractClass(Model::class);

        $model->setId('foo.123');
        static::assertEquals('foo.123', $model->getId());
    }

    /**
     * Test drop cache on import.
     */
    public function testImportExport()
    {
        /** @var Model $model */
        $model = $this->getMockForAbstractClass(Model::class);

        $model->setId('foo.123');
        static::assertEquals('foo.123', $model->getId());

        $model->import(['id' => 'foo.456']);
        static::assertEquals('foo.456', $model->getId());
    }
}
