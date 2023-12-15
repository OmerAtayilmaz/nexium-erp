<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';
use Routes\Router;

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


if($uri=='/documentation' || $uri=='/'){
    require_once BASE_PATH . '/Src/Docs/index.php';
    die();
}

//return JSON, NOT HTML
header('Content-Type: application/json');
$router = new Router();
require_once BASE_PATH . '/Src/Routes/v1/api.php';
require_once BASE_PATH . '/Src/Routes/v2/api.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);