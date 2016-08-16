<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Tests\Util\File;

use Comindware\Tracker\API\Util\File\LocalFile;

/**
 * Tests for Comindware\Tracker\API\Util\File\LocalFile
 *
 * @covers Comindware\Tracker\API\Util\File\LocalFile
 */
class LocalFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Basic checks.
     */
    public function testBasics()
    {
        $file = new LocalFile(__FILE__);

        static::assertEquals('LocalFileTest.php', $file->getFilename());
        $handle = $file->getResource();
        static::assertTrue(is_resource($handle));
        unset($file);
        static::assertFalse(is_resource($handle));
    }

    /**
     * Should throw RuntimeException if file not exists.
     *
     * @expectedException \Comindware\Tracker\API\Exception\RuntimeException
     */
    public function testFileNotExists()
    {
        new LocalFile('not.existed');
    }
}
