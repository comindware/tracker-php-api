<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

/**
 * DataSet service.
 *
 * TODO Дописать методы.
 *
 * @api
 * @since 0.1
 */
class DataSetService extends Service
{
    /**
     * Return base URI path.
     *
     * @return string
     *
     * @since 0.1
     */
    protected function getBase()
    {
        return '/Api/Dataset';
    }
}
