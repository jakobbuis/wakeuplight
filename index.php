<?php

require 'vendor/autoload.php';

// Load environment
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Connect to the bulb
$client = new \Yeelight\YeelightClient();
$bulbs = $client->search();
$bulb = $bulbs[getenv('YEELIGHT_IP')] ?? null;
if (!$bulb) {
    fwrite(STDERR, "Cannot connect to bulb\n");
    exit(1);
}

$bulb->setPower($argv[1], 'smooth', 5000);
