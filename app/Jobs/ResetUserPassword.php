<?php

namespace App\Jobs;

use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ResetUserPassword implements ShouldQueue
{
    use Queueable,InteractsWithQueue,Queueable,SerializesModels;

    public $tries = 10;

    #maximum alınabilir hata sayısı

    public $maxExceptions = 2;


    /**
     * Execute the job.
     */
    public function handle()
    {
        Log::debug("Reset Password Job Executed!");

        throw new \Exception("Cool exception");
        $this->release();
        //sleep(1);
       // return $this->release(2);
    }

    public function failed(){
        info("Cool job failed");
    }
}
