<?php

namespace App\Providers;

use App\Decorator\CachablePages;
use App\Repository\PageRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('Pages',function($app){
            return new CachablePages(new PageRepository());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
