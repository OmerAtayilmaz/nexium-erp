<?php
use Routes\Router;
use Controller\UserController;
use Controller\ProductController;

$router = new Router();
$router->get('/user', UserController::class,'index');
$router->post('/user', UserController::class,'store');

$router->get('/product',ProductController::class,'index');
$router->post('/product',ProductController::class,'store');