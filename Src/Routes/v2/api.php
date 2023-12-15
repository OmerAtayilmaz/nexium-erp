<?php

use Controller\UserController;
use Controller\ProductController;


$router->get('/api/v2/user', UserController::class,'index');

$router->post('/api/v2/user', UserController::class,'store');


$router->get('/api/v2/product',ProductController::class,'index');
$router->post('/api/v2/product',ProductController::class,'store');