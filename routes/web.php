<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "ERP LARAVEL REST API";
});


Route::resource('page-categories', App\Http\Controllers\PageCategoryController::class)->only('index', 'store');
