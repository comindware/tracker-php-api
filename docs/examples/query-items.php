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

$items = $tracker->items()->query(
    'AND($container == ID("tracker.4"), $resolved != true)',
    ['id' => 'Ascending'],
    ['id', 'title']
);
foreach ($items as $item) {
    printf(
        "%s: %s\n",
        $item->getId(),
        $item->get('title')
    );
}

// ds.1929
