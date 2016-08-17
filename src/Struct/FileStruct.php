<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Struct;

/**
 * FileContent structure.
 *
 * @since 0.1
 */
class FileStruct extends AbstractStruct
{
    /**
     * Return file name.
     *
     * @return string
     *
     * @since 0.1
     */
    public function getFilename()
    {
        return $this->getValue('fileName');
    }

    /**
     * Return file content as Base64 encoded string.
     *
     * @return string
     *
     * @since 0.1
     */
    public function getContentAsBase64()
    {
        return $this->getValue('contentBase64');
    }

    /**
     * Return file content as binary string.
     *
     * @return string
     *
     * @since 0.1
     */
    public function getContentAsBinary()
    {
        return base64_decode($this->getContentAsBase64());
    }

    /**
     * Return structure definition.
     *
     * @return array
     *
     * @since 0.1
     */
    protected function getStructureDefinition()
    {
        return [
            'contentBase64' => null,
            'fileName' => null
        ];
    }
}
