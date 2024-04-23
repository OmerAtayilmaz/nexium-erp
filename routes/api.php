<?php

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//WCMS Module
Route::prefix("wcms")->group(function(){
    Route::prefix("page")->controller(PageController::class)->group(function(){
        Route::get("/","index");
        Route::get("/show/{page}","show");
        Route::post("/store","store");
    });

    Route::prefix("component")->group(function(){

    });
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
