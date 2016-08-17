<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API\Model;

/**
 * Attachment.
 *
 * @since 0.1
 */
class Attachment extends Model
{
    /**
     * Return name.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getName()
    {
        return $this->getValue('name');
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @since 0.1
     */
    public function setName($name)
    {
        $this->setValue('name', (string) $name);
    }

    /**
     * Return URI.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getUri()
    {
        return $this->getValue('uri');
    }

    /**
     * Set URI.
     *
     * @param string $uri
     *
     * @since 0.1
     */
    public function setUri($uri)
    {
        $this->setValue('uri', (string) $uri);
    }

    /**
     * Return creation date and time.
     *
     * @return \DateTimeImmutable|null
     *
     * @since 0.1
     */
    public function getCreatedAt()
    {
        return $this->getCachedProperty(
            'date',
            function () {
                return $this->getValue('date')
                    ? new \DateTimeImmutable($this->getValue('date'))
                    : null;
            }
        );
    }

    /**
     * Set creation date and time.
     *
     * @param \DateTimeInterface|string $time
     *
     * @since 0.1
     */
    public function setCreatedAt($time)
    {
        if ($time instanceof \DateTimeInterface) {
            $time = $time->format(DATE_RFC3339);
        }

        $this->setValue('date', (string) $time);
    }

    /**
     * Return image width.
     *
     * @return int
     *
     * @since 0.1
     */
    public function getImageWidth()
    {
        return (int) $this->getValue('imageWidth');
    }

    /**
     * Set image width.
     *
     * @param int $width
     *
     * @since 0.1
     */
    public function setImageWidth($width)
    {
        $this->setValue('imageWidth', (int) $width);
    }

    /**
     * Return image height.
     *
     * @return int
     *
     * @since 0.1
     */
    public function getImageHeight()
    {
        return (int) $this->getValue('imageHeight');
    }

    /**
     * Set image height.
     *
     * @param int $height
     *
     * @since 0.1
     */
    public function setImageHeight($height)
    {
        $this->setValue('imageHeight', (int) $height);
    }

    /**
     * Return Attachment author.
     *
     * @return Account|null
     *
     * @throws \UnexpectedValueException
     *
     * @since 0.1
     */
    public function getAuthor()
    {
        return $this->getCachedProperty(
            'author',
            function () {
                try {
                    return $this->getValue('author')
                        ? new Account($this->getValue('author'))
                        : null;
                } catch (\InvalidArgumentException $e) {
                    throw new \UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
                }
            }
        );
    }

    /**
     * Set Attachment author.
     *
     * @param Account|string $objectOrId User or his ID.
     *
     * @throws \InvalidArgumentException
     *
     * @since 0.1
     */
    public function setAuthor($objectOrId)
    {
        $this->dropCachedProperty('author');
        if (!$objectOrId instanceof Account) {
            $objectOrId = new Account(['id' => $objectOrId]);
        }

        $this->setValue('author', $objectOrId->export());
    }
}
