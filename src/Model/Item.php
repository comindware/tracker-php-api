<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Model;

/**
 * Item.
 *
 * TODO Дописать свойства.
 *
 * @since 0.1
 */
class Item extends Model
{
    /**
     * Item identifier.
     *
     * @var string
     *
     * @since 0.1
     */
    public $id;

    /**
     * Application identifier that contains this item.
     *
     * @var string
     *
     * @since 0.1
     */
    public $applicationId;

    /**
     * Item prototype identifier.
     *
     * @var string
     *
     * @since 0.1
     */
    public $prototypeId;

    /**
     * Item type.
     *
     * @var string "Task", "Document" or "Tracker".
     *
     * @since 0.1
     */
    public $type;

    /**
     * Create Item from array.
     *
     * @param array $data
     *
     * @since 0.1
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
    }
}
