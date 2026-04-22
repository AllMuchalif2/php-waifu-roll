<?php
session_start();
define('BASE_PATH', realpath(__DIR__ . '/../'));

// Simple Autoloader
spl_autoload_register(function ($class) {
    $file = BASE_PATH . '/' . str_replace('\\', '/', $class);
    $file = str_replace('App/', 'app/', $file) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Core\Router;

// Initialize Router
$router = new Router();
