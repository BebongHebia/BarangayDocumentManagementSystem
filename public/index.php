<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Check if maintenance mode is on
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register autoloader
require __DIR__.'/../vendor/autoload.php';

// FORCE SET APP_KEY BEFORE BOOTING
$appKey = getenv('APP_KEY');
if (!$appKey) {
    $appKey = $_ENV['APP_KEY'] ?? null;
}
if (!$appKey) {
    $appKey = $_SERVER['APP_KEY'] ?? null;
}

if ($appKey) {
    putenv("APP_KEY=$appKey");
    $_ENV['APP_KEY'] = $appKey;
    $_SERVER['APP_KEY'] = $appKey;
}

// Bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Request::capture();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);