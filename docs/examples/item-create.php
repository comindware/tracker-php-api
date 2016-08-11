<?php
/**
 * This example should be executed in console.
 */
namespace Comindware\Tracker\API\Examples;

use Comindware\Tracker\API\Api;
use Comindware\Tracker\API\Client;
use Comindware\Tracker\API\Model\Item;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;

require __DIR__ . '/inc/init.php';

$client = new Client(
    getenv('TRACKER_URI'),
    getenv('TRACKER_TOKEN'),
    HttpClientDiscovery::find(),
    MessageFactoryDiscovery::find()
);
$tracker = new Api($client);

$item = new Item();
$item->set('title', 'Foo');
$item->set('description', '<h1>Foo</h1> <p>Bar baz.</p>');

$appId = 'tracker.157'; // Set to your own.

$id = $tracker->item()->createItem($appId, $item);
$item = $tracker->item()->getItem($id);

printf(
    "App: %s\nType: %s\nCreator: %s\nCreated: %s\n",
    $item->getApplicationId(),
    $item->getType(),
    $item->getCreator()->getFullName(),
    $item->getCreatedAt()->format(DATE_RFC3339)
);
foreach ($item->getProperties() as $property => $value) {
    printf("  %s: %s\n", $property, $value);
}
