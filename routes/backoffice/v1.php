<?php

use App\Decorator\CachablePages;
use App\Http\Controllers\Api\V1\PageController;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Models\Page;
use App\Repository\PageRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

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



Route::get('/redis',function(){
 //  $value =  Redis::incr('visits');
   $value =  Redis::incrBy('visits',5);
   return $value;
});

Route::get('/redis/pages/delete',function(){

    Redis::del('amator');
    return response()->json([
        'status' => 200,
        'message' => 'All cache purged.'
    ]);
});

Route::get('/redis/pages',function(){

    if(!Redis::exists('amator')){
        $data = Page::paginate(200);
        Redis::set('amator',json_encode($data));
    }
    

      // Retrieve and decode the data from Redis
      $cachedData = json_decode(Redis::get('amator'), true);

    
    return response()->json($cachedData);
});

Route::get('/redis/pages/{id}',function($id){


    if(!Redis::exists("page.{$id}.show")){
        $pageData = json_encode(Page::find($id));
        Redis::set("page.{$id}.show", $pageData );
    }

    $cachedData = json_decode(Redis::get("page.{$id}.show"),true);

    return response()->json([
        'status' => 200,
        'data' => $cachedData
    ]);
});

//Article Visiting Strategy
Route::get('/redis/article/{id}',function($id){

    Redis::zincrby('trending_articles',1,$id);

    return response()->json([
        'status' => 200,
        'message' => "{$id} - Article Visited."
    ]);
});

Route::get('/redis/popular-articles',function(){

    $trendingArticles = Redis::zrevrange('trending_articles',0,3);

    return response()->json([
        'status' => 200,
        'data' =>  $trendingArticles
    ]);
});


// User Stats Strategy
Route::get('/redis/user/favourites', function(){

    /*
      $user1Stats = [
        'favourites' => 50,
        'watchLaters' => 90,
        'completions' => 25
    ];

    //hmset 
    //hgetall
    
  
    Redis::hmset('user.1.stats', $user1Stats);
   
*/
   return Redis::hgetall("user.1.stats");

});

Route::get('/redis/user/{id}/stats', function($id){
    return Redis::hgetall("user.{$id}.stats");
});

Route::get('/redis/video', function(){
    
    Cache::set("via_cache_facade","dataaaa");
    Redis::hincrby("user.1.stats",'favourites',1);
    
    return response()->json([
        'status' => 200,
        'message' => Cache::get("via_cache_facade")
    ]);
});

//Pattern to implement Cache Mechanism 

Route::get('/redis/posts',function(){
   $cachablePages = app("Pages");
   return $cachablePages->all();
});

//JOB

Route::get('/job',function(){

   
    /* Bu yöntem job'u doğrudan çalıştırır, genellikle kuyruğa sokar ve sırasıyla çalışmasını isteriz. 
    $job = new SendWelcomeEmail();
    $job->handle();

    */

    SendWelcomeEmail::dispatch();


    //php artisan queue:work will run all tasks sequentially in the queue then listen for new one.
});