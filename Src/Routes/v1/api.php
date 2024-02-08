<?php

use Controller\UserController;
use Controller\ProductController;
use Controller\SwaggerController;

$router->get('/api/documentation', SwaggerController::class,'documentation');


$router->get('/api/v1/user', UserController::class,'index');

$router->post('/api/v1/user/register', UserController::class,'register');
$router->post('/api/v1/user/login', UserController::class,'login');
$router->post('/api/v1/user/verify-token',UserController::class,'verify_token');

$router->get('/api/v1/user/dashboard', UserController::class, 'dashboard');

$router->get('/api/v1/product',ProductController::class,'index');
$router->post('/api/v1/product',ProductController::class,'store');