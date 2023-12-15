<?php

require 'vendor/autoload.php';
require __DIR__ . '/bootstrap.php';


const BASE_PATH = __DIR__;


//return JSON, NOT HTML
header('Content-Type: application/json');

function base_path($path)
{
    return BASE_PATH . $path;
}

use Routes\Router;
use Controller\UserController;

$router = new Router();
$router->get('/user', UserController::class,'index');
$router->post('/user', UserController::class,'store');



$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($uri, $method);