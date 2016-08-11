<?php
/**
 * Shared init part.
 */
require __DIR__ . '/../../../vendor/autoload.php';

if (!getenv('TRACKER_URI')) {
    die("You should specify Tracker URI via TRACKER_URI environment variable!\n");
}

if (!getenv('TRACKER_TOKEN')) {
    die("You should specify authentication token via TRACKER_TOKEN environment variable!\n");
}
