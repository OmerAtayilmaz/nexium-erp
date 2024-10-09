<?php

use App\Http\Controllers\Api\V1\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;

//export routes and import in api.php
//WCMS Module

Route::prefix('auth')->controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::middleware('auth:sanctum')->post('logout','logout');
    Route::post('register','register');
    Route::post('forgot-password','forgot-password');
    Route::post('reset-password','reset-password');
});

Route::prefix("wcms")->name('wcms.')->group(function () {
    Route::prefix("page")->name('page.')->controller(PageController::class)->group(function () {
        Route::get("/", "index")->name('index');
        Route::get("/show/{id}", "show")->name('show');;
        Route::post("/store", "store");
        Route::put("/update/{id}", "update");
        Route::delete("/destroy/{id}", "destroy");
    });

    Route::apiResource('page-category', App\Http\Controllers\Api\V1\PageCategoryController::class)->only('index', 'show');

});

Route::middleware('auth:sanctum')
->apiResource('users',UserController::class)->except('store','update');