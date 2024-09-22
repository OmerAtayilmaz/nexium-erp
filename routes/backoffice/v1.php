<?php

use App\Http\Controllers\Api\V1\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;


//export routes and import in api.php
//WCMS Module

Route::prefix('auth')->controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::middleware('auth:sanctum')->post('logout','logout');
    Route::post('register','register');
    Route::post('forgot-password','forgot-password');
    Route::post('reset-password','reset-password');
});

Route::prefix("wcms")->group(function () {
    Route::prefix("page")->controller(PageController::class)->group(function () {
        Route::get("/", "index");
        Route::get("/show/{page}", "show");
        Route::post("/store", "store");
        Route::put("/update/{id}", "update");
        Route::delete("/destroy/{id}", "destroy");
    });


    Route::resource('page-category', App\Http\Controllers\Api\V1\PageCategoryController::class)->only('index', 'show');

});
