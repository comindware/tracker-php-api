<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Model;

use Comindware\Tracker\API\Struct\AbstractStruct;

use Mekras\ClassHelpers\Traits\GettersCacheTrait;

/**
 * Abstract API data model.
 *
 * @since 0.1
 */
abstract class Model extends AbstractStruct
{
    use GettersCacheTrait;

    /**
     * Import data from an array.
     *
     * @param array $data
     *
     * @since 0.1
     */
    public function import(array $data)
    {
        parent::import($data);
        $this->dropCachedProperties();
    }

    /**
     * Return model ID.
     *
     * @return string
     *
     * @since 0.1
     */
    public function getId()
    {
        return $this->getValue('id');
    }

    /**
     * Set model ID.
     *
     * @param string $id
     *
     * @since 0.1
     */
    public function setId($id)
    {
        $this->setValue('id', (string) $id);
    }
}
