<?php

use Controller\UserController;
use Controller\ProductController;
use Controller\SwaggerController;

$router->get('/api/documentation', SwaggerController::class,'documentation');


$router->get('/api/v1/user', UserController::class,'index');
$router->post('/api/v1/user', UserController::class,'store');
$router->post('/api/v1/user/register', UserController::class,'register');

$router->get('/api/v1/product',ProductController::class,'index');
$router->post('/api/v1/product',ProductController::class,'store');