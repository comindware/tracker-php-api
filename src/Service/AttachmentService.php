<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Service;

use Comindware\Tracker\API\Util\File\File;

/**
 * Attachment service.
 *
 * TODO Дописать методы.
 *
 * @api
 * @since 0.1
 */
class AttachmentService extends Service
{
    /**
     * Create {@see \Comindware\Tracker\API\Model\Attachment}.
     *
     * @param string $itemId {@see \Comindware\Tracker\API\Model\Item} ID.
     * @param File   $file   File to attach.
     *
     * @return string Created attachment ID.
     *
     * @throws \Comindware\Tracker\API\Exception\RuntimeException In case of non-API errors.
     * @throws \Comindware\Tracker\API\Exception\WebApiClientException Ore one of descendants.
     *
     * @since 0.1
     */
    public function create($itemId, File $file)
    {
        return $this->client->sendRequest(
            $this->getBase() . '/' . $itemId,
            'POST',
            ['file' => $file]
        );
    }

    /**
     * Return base URI path.
     *
     * @return string
     *
     * @since 0.1
     */
    protected function getBase()
    {
        return '/Api/Attachment';
    }
}
