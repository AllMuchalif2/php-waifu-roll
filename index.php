<?php
session_start();

// Simple Autoloader
spl_autoload_register(function ($class) {
    $file = str_replace('\\', '/', $class);
    $file = str_replace('App/', 'app/', $file) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Core\Router;

// Initialize Router
$router = new Router();