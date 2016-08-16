<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Util\File;

/**
 * File, that can be attached to Item.
 *
 * @api
 * @since 0.1
 */
interface File
{
    /**
     * Return file name (without path).
     *
     * @return string
     *
     * @since 0.1
     */
    public function getFilename();

    /**
     * Open file for reading and return related resource.
     *
     * @return resource
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException If file can not be opened.
     *
     * @since 0.1
     */
    public function getResource();
}
