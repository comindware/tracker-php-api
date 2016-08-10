<?php
/**
 * This example should be executed in console.
 */
namespace Comindware\Tracker\API\Examples;

use Comindware\Tracker\API\Api;
use Comindware\Tracker\API\Client;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;

require __DIR__ . '/../../vendor/autoload.php';

$baseUri = getenv('TRACKER_URI');
if (!$baseUri) {
    die("You should specify Tracker URI via TRACKER_URI environment variable!\n");
}

$token = getenv('TRACKER_TOKEN');
if (!$token) {
    die("You should specify authentication token via TRACKER_TOKEN environment variable!\n");
}

$client = new Client(
    $baseUri,
    $token,
    HttpClientDiscovery::find(),
    MessageFactoryDiscovery::find()
);
$tracker = new Api($client);

$workspaces = $tracker->workspace()->getWorkspaces();
foreach ($workspaces as $workspace) {
    printf("%s: %s (%s)\n", $workspace->id, $workspace->name, $workspace->description);
}
