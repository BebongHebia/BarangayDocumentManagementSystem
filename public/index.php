<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Check if maintenance mode is on
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register autoloader
require __DIR__.'/../vendor/autoload.php';

// Force environment variable to be read
$appKey = getenv('APP_KEY');
if (!$appKey) {
    // Try to get from $_ENV
    $appKey = $_ENV['APP_KEY'] ?? null;
}
if (!$appKey) {
    // Try to get from $_SERVER
    $appKey = $_SERVER['APP_KEY'] ?? null;
}

if (!$appKey) {
    die('ERROR: APP_KEY is not set in environment');
}

// Bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Set the key manually if needed
if (empty($app['config']->get('app.key'))) {
    $app['config']->set('app.key', $appKey);
}

// Handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Request::capture();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
