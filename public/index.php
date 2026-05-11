<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('VIEW_PATH', APP_PATH . '/views');

session_start();

$router = new App\Core\Router;
$router->dispatch($_SERVER['REQUEST_URI']);