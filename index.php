<?php

require 'vendor/autoload.php';
require __DIR__ . '/bootstrap.php';
require BASE_PATH . '/api.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);