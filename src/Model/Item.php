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
     * Create new Item.
     *
     * @param array|null $data Data that should be imported into model.
     *
     * @since 0.1
     */
    public function __construct(array $data = null)
    {
        if (null === $data) {
            $data = [];
        }
        if (!array_key_exists('properties', $data)) {
            $data['properties'] = [];
        }
        parent::__construct($data);
    }

    /**
     * Return Application identifier that contains this item.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getApplicationId()
    {
        return $this->getProperty('application');
    }

    /**
     * Set Application identifier that contains this item.
     *
     * @param Application|string $objectOrId Application or its ID.
     *
     * @since 0.1
     */
    public function setApplicationId($objectOrId)
    {
        if ($objectOrId instanceof Application) {
            $objectOrId = $objectOrId->getId();
        }

        $this->setProperty('application', (string) $objectOrId);
    }

    /**
     * Return Item prototype identifier.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getPrototypeId()
    {
        return $this->getProperty('prototypeId');
    }

    /**
     * Set Item prototype identifier.
     *
     * @param Prototype|string $objectOrId Prototype or its ID.
     *
     * @since 0.1
     */
    public function setPrototypeId($objectOrId)
    {
        if ($objectOrId instanceof Prototype) {
            $objectOrId = $objectOrId->getId();
        }

        $this->setProperty('prototypeId', (string) $objectOrId);
    }

    /**
     * Return Item type.
     *
     * @return string|null "Task", "Document" or "Tracker".
     *
     * @since 0.1
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Set Item type.
     *
     * @param string $type "Task", "Document" or "Tracker".
     *
     * @since 0.1
     */
    public function setType($type)
    {
        $this->setProperty('type', (string) $type);
    }

    /**
     * Return Item creator.
     *
     * @return Account|null
     *
     * @since 0.1
     */
    public function getCreator()
    {
        return $this->getCachedProperty(
            'creator',
            function () {
                return $this->getProperty('creator')
                    ? new Account($this->getProperty('creator'))
                    : null;
            }
        );
    }

    /**
     * Set Item creator.
     *
     * @param Account|string $objectOrId Account or its ID.
     *
     * @since 0.1
     */
    public function setCreator($objectOrId)
    {
        $this->dropCachedProperty('creator');
        if (!$objectOrId instanceof Account) {
            $objectOrId = new Account(['id' => $objectOrId]);
        }

        $this->setProperty('creator', $objectOrId->export());
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
            'creationDate',
            function () {
                return $this->getProperty('creationDate')
                    ? new \DateTimeImmutable($this->getProperty('creationDate'))
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

        $this->setProperty('creationDate', (string) $time);
    }

    /**
     * Return all properties as associative array.
     *
     * @return array
     *
     * @since 0.1
     */
    public function getProperties()
    {
        $names = array_keys($this->getProperty('properties'));
        $result = [];
        foreach ($names as $name) {
            $result[$name] = $this->get($name);
        }

        return $result;
    }

    /**
     * Return Item property.
     *
     * @param string $property Property name.
     * @param mixed  $default  Default property value.
     *
     * @return mixed
     *
     * @since 0.1
     */
    public function get($property, $default = null)
    {
        $properties = $this->getProperty('properties', []);
        if (array_key_exists($property, $properties)) {
            $value = $properties[$property];
            if (is_array($value)) {
                $value = reset($value);
            }

            return $value;
        }

        return $default;
    }

    /**
     * Set Item property value.
     *
     * @param string $property Property name.
     * @param mixed  $value    Property value.
     *
     * @since 0.1
     */
    public function set($property, $value)
    {
        $properties = $this->getProperty('properties', []);
        $properties[$property] = [$value];
        $this->setProperty('properties', $properties);
    }
}
