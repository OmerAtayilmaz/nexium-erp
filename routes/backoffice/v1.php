<?php

use App\Http\Controllers\Api\V1\PageController;
use Illuminate\Support\Facades\Route;

//export routes and import in api.php
//WCMS Module
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
