<?php

use Dotenv\Dotenv;
use WakeupLight\WakeupProgramme;
use Yeelight\Bulb\Bulb;
use Yeelight\YeelightClient;

// This script is executed every minute by cron. The actual start time is defined
// in ./trigger. Check that timestamp and fire the script if it matches
$trigger = @file_get_contents(__DIR__ . '/trigger');
if ($trigger === false) {
    fwrite(STDERR, "No trigger file specified\n");
    exit(0);
}
$trigger = trim($trigger);
$now = date('H:i');
if ($trigger !== $now) {
    fwrite(STDERR, "Now {$now} is not equal to defined trigger {$trigger}, not firing.\n");
    exit(0);
}

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
