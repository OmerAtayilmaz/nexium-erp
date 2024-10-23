<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class Deploy implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
       
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         //birden fazla worker ile çalışırken; *Race conditionun* önüne geçiyoruz.
         Cache::lock("deployments")->block(10,function(){
            info("Started Deploying...");
            sleep(5);
            info("Finished Deploying!");
        });
   
        /*
        job1 başlayıp bitene kadar job2 başlamaz
        job1 biter, job2 baslar ve biter
        */

        //redis karşılığı
        /*
        Redis::funnel("deployments")
        ->limit(5)
        ->block(10)
        ->then(function(){
            info("Started Deploying...");
            sleep(5);
            info("Finished Deploying!");
        });

        // allow 10 deployments every 60 seconds (Redis)
        ->allow(10) 10 deployments
        ->every(60) 60 seconds
        */
    }

    public function middleware(){
        return [
            new WithoutOverlapping("deployment", 10) 
        ];
    }


}
