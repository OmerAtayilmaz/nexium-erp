<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "ERP LARAVEL REST API";
});


Route::resource('page-categories', App\Http\Controllers\Api\V1\PageCategoryController::class)->only('index', 'store');
