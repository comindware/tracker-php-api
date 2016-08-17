<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Model;

/**
 * Account.
 *
 * @since 0.1
 */
class Account extends Model
{
    /**
     * Construct new model.
     *
     * @param array|null $data Data that should be imported into model.
     *
     * @since 0.1
     */
    public function __construct(array $data = null)
    {
        /*
         * Workaround for API inconsistency in method «GET /Api/Account/{id}»
         */
        if (array_key_exists('name', $data)) {
            $data['fullName'] = $data['name'];
            unset($data['name']);
        }
        parent::__construct($data);
    }

    /**
     * Return name.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getFullName()
    {
        return $this->getValue('fullName');
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @since 0.1
     */
    public function setFullName($name)
    {
        $this->setValue('fullName', (string) $name);
    }
}
