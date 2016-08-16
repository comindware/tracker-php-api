<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Model;

use Comindware\Tracker\API\Model\Attachment;

/**
 * Tests for Comindware\Tracker\API\Model\Attachment
 *
 * @covers Comindware\Tracker\API\Model\Attachment
 */
class AttachmentTest extends \PHPUnit_Framework_TestCase
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
            'id' => 'rev.123',
            'name' => 'foo.jpg',
            'uri' => '/GetAttachment.ashx?id=rev.123',
            'date' => '2016-01-01T01:23:45',
            'imageWidth' => 0,
            'imageHeight' => 0,
            'author' => []
        ];
        $model = new Attachment();

        $model->import($data);
        static::assertEquals('rev.123', $model->getId());

        static::assertEquals($data, $model->export());
    }
}
