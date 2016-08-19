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
     * Return description.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getDescription()
    {
        return $this->getValue('description');
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
        $this->setValue('description', (string) $description);
    }

    /**
     * Return application type.
     *
     * @return string|null "Task", "Document" or "Tracker".
     *
     * @since 0.1
     */
    public function getType()
    {
        return $this->getValue('kind');
    }

    /**
     * Set application type.
     *
     * @param string $kind "Task", "Document" or "Tracker".
     *
     * @since 0.1
     */
    public function setType($kind)
    {
        $this->setValue('kind', (string) $kind);
    }

    /**
     * Return Workspaces that contain this application.
     *
     * @return Workspace[]
     * @throws \UnexpectedValueException
     *
     * @since x.x
     */
    public function getWorkspaces()
    {
        return $this->getCachedProperty(
            'workspaces',
            function () {
                $result = [];
                $items = $this->getValue('workspaces');
                if (is_array($items)) {
                    /** @var array $items */
                    foreach ($items as $item) {
                        try {
                            $result[] = new Workspace($item);
                        } catch (\InvalidArgumentException $e) {
                            throw new \UnexpectedValueException(
                                $e->getMessage(),
                                $e->getCode(),
                                $e
                            );
                        }
                    }
                }

                return $result;
            }
        );
    }
}
