<?php

// Suppress all output until we're ready
if (ob_get_level()) ob_end_clean();
ob_start();

// Error handling
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    error_log("PHP Error: $errstr in $errfile:$errline");
    return true;
});

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Check maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoload
require __DIR__.'/../vendor/autoload.php';

// Check for any output before Laravel boots
if (ob_get_length() > 0) {
    error_log("=== OUTPUT BEFORE BOOTSTRAP: " . ob_get_contents());
    ob_clean();
}

try {
    // Bootstrap the application
    $app = require_once __DIR__.'/../bootstrap/app.php';

    // Create kernel
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    // Handle request
    $request = Request::capture();
    $response = $kernel->handle($request);

    // Send response
    $response->send();

    // Terminate
    $kernel->terminate($request, $response);

} catch (\Exception $e) {
    error_log("=== FATAL: " . $e->getMessage());
    error_log("=== FILE: " . $e->getFile() . ":" . $e->getLine());

    // Clean buffer and show error
    ob_clean();
    http_response_code(500);
    echo "Application Error: " . htmlspecialchars($e->getMessage());
}