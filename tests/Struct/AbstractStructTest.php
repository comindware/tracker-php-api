<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Struct;

use Comindware\Tracker\API\Struct\AbstractStruct;

/**
 * Tests for Comindware\Tracker\API\Struct\AbstractStruct.
 */
class AbstractStructTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test import/export.
     *
     * All data should be imported.
     * All imported values should be exported.
     */
    public function testImportExport()
    {
        $data = ['foo' => 'bar', 'baz' => 'boo'];

        /** @var AbstractStruct $struct */
        $struct = $this->getMockForAbstractClass(AbstractStruct::class, [$data]);

        static::assertEquals($data, $struct->export());
    }
}
