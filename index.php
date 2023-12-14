<?php

require 'vendor/autoload.php';
require __DIR__ . '/bootstrap.php';
require __DIR__ . '/database.php';

const BASE_PATH = __DIR__;

function base_path($path)
{
    return BASE_PATH . $path;
}

use Routes\Router;

$router = new Router();
$router->get('/user','/user.php');
$router->post('/user','/user.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($uri, $method);