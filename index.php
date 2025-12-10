<?php
// index.php - Entry point with Laravel-style routing
session_start();

// Load configuration
require_once 'config/config.php';
require_once 'config/Database.php';

// Load routes
require_once 'routes.php';

// Get request URI and method
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace(BASE_PATH, '', $requestUri);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remove base path if any (for subfolder installations)
$basePath = ''; // Set to empty as per user request
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}
if ($requestUri === '' || $requestUri === '/index.php') {
    $requestUri = '/';
}
//echo $_SERVER['REQUEST_URI'];die();
// Dispatch the route
try {
    Route::dispatch($requestUri, $requestMethod);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>