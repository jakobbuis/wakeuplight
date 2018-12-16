<?php

use WakeupLight\Manager;

require 'vendor/autoload.php';

// Load environment
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$manager = new Manager(getenv('YEELIGHT_IP'));
$manager->manage();
