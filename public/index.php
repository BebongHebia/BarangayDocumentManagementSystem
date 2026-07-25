<?php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

try {
    // Check if maintenance mode is on
    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    // Register autoloader
    require __DIR__.'/../vendor/autoload.php';

    // Debug: Check APP_KEY
    error_log("=== APP_KEY from env: " . (getenv('APP_KEY') ?: 'NOT SET'));

    // Bootstrap Laravel
    $app = require_once __DIR__.'/../bootstrap/app.php';

    // Debug: Check if app is loaded
    error_log("=== App loaded successfully");

    // Handle the request
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $request = Request::capture();
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);

} catch (\Exception $e) {
    error_log("=== ERROR Test: " . $e->getMessage());
    error_log("=== FILE Test : " . $e->getFile() . ":" . $e->getLine());
    error_log("=== TRACE Test : " . $e->getTraceAsString());

    // Show error
    echo "<h1>Application Error</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . ":" . $e->getLine() . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
