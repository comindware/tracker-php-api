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
     * Return name.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getName()
    {
        return $this->getProperty('name');
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
        $this->setProperty('name', (string) $name);
    }

    /**
     * Return description.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getDescription()
    {
        return $this->getProperty('description');
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @since 0.1
     */
    public function setDescription($description)
    {
        $this->setProperty('description', (string) $description);
    }

    /**
     * Return container identifier that contains this workspace.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getContainerId()
    {
        return $this->getProperty('containerId');
    }

    /**
     * Set container identifier that contains this workspace.
     *
     * @param Model|string $objectOrId Container model or ID.
     *
     * @since 0.1
     */
    public function setContainerId($objectOrId)
    {
        if ($objectOrId instanceof Model) {
            $objectOrId = $objectOrId->getId();
        }

        $this->setProperty('containerId', (string) $objectOrId);
    }
}
