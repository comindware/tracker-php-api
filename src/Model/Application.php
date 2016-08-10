<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Model;

/**
 * Application.
 *
 * An Application is a collection of items of the same type. There are three types of applications
 * in Comindware Tracker:
 *
 * - workflow app which creates and stores workflow tasks processed by a workflow;
 * - tasks app which creates and stores different tasks scattered across your team;
 * - documents app which creates and stores documents of the same type.
 *
 * @since 0.1
 */
class Application extends Model
{
    /**
     * Application identifier.
     *
     * @var string
     *
     * @since 0.1
     */
    public $id;

    /**
     * Application name.
     *
     * @var string
     *
     * @since 0.1
     */
    public $name;

    /**
     * Application description.
     *
     * @var string|null
     *
     * @since 0.1
     */
    public $description;

    /**
     * Application type.
     *
     * @var string "Task", "Document" or "Tracker".
     *
     * @since 0.1
     */
    public $kind;

    /**
     * Workspaces that contain this application.
     *
     * @var Workspace[]
     *
     * @since 0.1
     */
    public $workspaces;

    /**
     * Create Application from array.
     *
     * @param array $data
     *
     * @since 0.1
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = array_key_exists('description', $data) ? $data['description'] : null;
        $this->kind = $data['kind'];
        $this->workspaces = [];
        if (array_key_exists('workspaces', $data) && is_array($data['workspaces'])) {
            foreach ($data['workspaces'] as $item) {
                $this->workspaces[] = new Workspace($item);
            }
        }
    }
}
