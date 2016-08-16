<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Util\File;

use Comindware\Tracker\API\Exception\RuntimeException;

/**
 * Local file, that can be attached to Item.
 *
 * @api
 * @since 0.1
 */
class LocalFile implements File
{
    /**
     * Full file path.
     *
     * @var string
     */
    private $path;

    /**
     * Base file name.
     *
     * @var string
     */
    private $filename;

    /**
     * File handle.
     *
     * @var resource|null
     */
    private $handle = null;

    /**
     * Create new LocalFile instance.
     *
     * @param string      $path     Full path to local file.
     * @param string|null $filename Override basename with this name.
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException If file not found or not readable.
     *
     * @since 0.1
     */
    public function __construct($path, $filename = null)
    {
        if (!file_exists($path)) {
            throw new RuntimeException(sprintf('File "%s" not found', $path));
        }
        if (!is_readable($path)) {
            throw new RuntimeException(sprintf('File "%s" not found', $path));
        }

        $this->path = $path;
        $this->filename = $filename ?: basename($path);
    }

    /**
     * Destruct instance.
     *
     * @since 0.1
     */
    public function __destruct()
    {
        if (is_resource($this->handle)) {
            fclose($this->handle);
        }
    }

    /**
     * Return file name (without path).
     *
     * @return string
     *
     * @since 0.1
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Open file for reading and return related resource.
     *
     * @return resource
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException If file can not be opened.
     *
     * @since 0.1
     */
    public function getResource()
    {
        if (null === $this->handle) {
            $this->handle = fopen($this->path, 'r');
        }

        return $this->handle;
    }
}
