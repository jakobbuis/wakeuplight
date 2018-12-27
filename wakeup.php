<?php

use Dotenv\Dotenv;
use WakeupLight\WakeupProgramme;
use Yeelight\Bulb\Bulb;
use Yeelight\YeelightClient;

// Bootstrap system
require 'vendor/autoload.php';
$dotenv = new Dotenv(__DIR__);
$dotenv->load();

// Connect to bulb
$client = new YeelightClient();
$bulbs = $client->search();
$bulb = $bulbs[getenv('YEELIGHT_IP')] ?? null;
if (!$bulb) {
    fwrite(STDERR, "Cannot connect to bulb\n");
    exit(1);
}

// Kick off programme
$programme = new WakeupProgramme;
$programme->runOn($bulb);
