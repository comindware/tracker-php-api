<?php
/**
 * This example should be executed in console.
 */
namespace Comindware\Tracker\API\Examples;

use Comindware\Tracker\API\Api;
use Comindware\Tracker\API\Client;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\StreamFactoryDiscovery;

require __DIR__ . '/inc/init.php';

$client = new Client(
    getenv('TRACKER_URI'),
    getenv('TRACKER_TOKEN'),
    HttpClientDiscovery::find(),
    MessageFactoryDiscovery::find(),
    StreamFactoryDiscovery::find()
);
$tracker = new Api($client);

$workspaces = $tracker->workspace()->getWorkspaces();
foreach ($workspaces as $workspace) {
    printf(
        "%s: %s (%s)\n",
        $workspace->getId(),
        $workspace->getName(),
        $workspace->getDescription()
    );
}
