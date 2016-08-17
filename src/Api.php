<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API;

use Comindware\Tracker\API\Service\AccountService;
use Comindware\Tracker\API\Service\AppService;
use Comindware\Tracker\API\Service\AttachmentService;
use Comindware\Tracker\API\Service\AuthenticationService;
use Comindware\Tracker\API\Service\CommentService;
use Comindware\Tracker\API\Service\DataService;
use Comindware\Tracker\API\Service\DataSetService;
use Comindware\Tracker\API\Service\FavoriteService;
use Comindware\Tracker\API\Service\ItemService;
use Comindware\Tracker\API\Service\PrototypeService;
use Comindware\Tracker\API\Service\Service;
use Comindware\Tracker\API\Service\TimespentService;
use Comindware\Tracker\API\Service\WorkflowService;
use Comindware\Tracker\API\Service\WorkspaceService;

/**
 * Tracker high-level interface.
 *
 * @api
 * @since 0.1
 */
class Api
{
    /**
     * Tracker client.
     *
     * @var Client
     */
    private $client;

    /**
     * Service instances cache.
     *
     * @var Service[]
     */
    private $services = [];

    /**
     * Create new Tracker interface.
     *
     * @param Client $client Tracker API client.
     *
     * @since 0.1
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Return Tracker API client.
     *
     * @return Client
     *
     * @since 0.1
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Return Account service.
     *
     * @return AccountService
     *
     * @since 0.1
     */
    public function accounts()
    {
        return $this->getService(AccountService::class);
    }

    /**
     * Return App service.
     *
     * @return AppService
     *
     * @since 0.1
     */
    public function app()
    {
        return $this->getService(AppService::class);
    }

    /**
     * Return Attachment service.
     *
     * @return AttachmentService
     *
     * @since 0.1
     */
    public function attachments()
    {
        return $this->getService(AttachmentService::class);
    }

    /**
     * Return Authentication service.
     *
     * @return AuthenticationService
     *
     * @since 0.1
     */
    public function authentication()
    {
        return $this->getService(AuthenticationService::class);
    }

    /**
     * Return Comment service.
     *
     * @return CommentService
     *
     * @since 0.1
     */
    public function comment()
    {
        return $this->getService(CommentService::class);
    }

    /**
     * Return Data service.
     *
     * @return DataService
     *
     * @since 0.1
     */
    public function data()
    {
        return $this->getService(DataService::class);
    }

    /**
     * Return DataSet service.
     *
     * @return DataSetService
     *
     * @since 0.1
     */
    public function dataset()
    {
        return $this->getService(DataSetService::class);
    }

    /**
     * Return Favorite service.
     *
     * @return FavoriteService
     *
     * @since 0.1
     */
    public function favorite()
    {
        return $this->getService(FavoriteService::class);
    }

    /**
     * Return Item service.
     *
     * @return ItemService
     *
     * @since 0.1
     */
    public function items()
    {
        return $this->getService(ItemService::class);
    }

    /**
     * Return Prototype service.
     *
     * @return PrototypeService
     *
     * @since 0.1
     */
    public function prototype()
    {
        return $this->getService(PrototypeService::class);
    }

    /**
     * Return Timespent service.
     *
     * @return TimespentService
     *
     * @since 0.1
     */
    public function timespent()
    {
        return $this->getService(TimespentService::class);
    }

    /**
     * Return Workflow service.
     *
     * @return WorkflowService
     *
     * @since 0.1
     */
    public function workflow()
    {
        return $this->getService(WorkflowService::class);
    }

    /**
     * Return Workspace service.
     *
     * @return WorkspaceService
     *
     * @since 0.1
     */
    public function workspaces()
    {
        return $this->getService(WorkspaceService::class);
    }

    /**
     * Return service singleton.
     *
     * @param string $class
     *
     * @return Service
     */
    private function getService($class)
    {
        if (!array_key_exists($class, $this->services)) {
            $this->services[$class] = new $class($this->getClient());
        }

        return $this->services[$class];
    }
}
