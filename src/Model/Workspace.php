<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Model;

/**
 * Workspace.
 *
 * A Workspace is a team or a project that contains {@see Application Applications}.
 *
 * @since 0.1
 */
class Workspace extends Model
{
    /**
     * Workspace identifier.
     *
     * @var string
     *
     * @since 0.1
     */
    public $id;

    /**
     * Workspace name.
     *
     * @var string|null
     *
     * @since 0.1
     */
    public $name;

    /**
     * Workspace description.
     *
     * @var string|null
     *
     * @since 0.1
     */
    public $description;

    /**
     * Container identifier that contains this workspace.
     *
     * @var string|null
     *
     * @since 0.1
     */
    public $containerId;

    /**
     * Create Workspace from array.
     *
     * @param array $data
     *
     * @since 0.1
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = array_key_exists('name', $data) ? $data['name'] : null;
        $this->description = array_key_exists('description', $data) ? $data['description'] : null;
        $this->containerId = array_key_exists('containerId', $data) ? $data['containerId'] : null;
    }
}
