<?php

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function(){
    require __DIR__ .'/backoffice/v1.php';
});

Route::prefix('v2')->group(function(){
    require __DIR__ .'/backoffice/v1.php';
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
