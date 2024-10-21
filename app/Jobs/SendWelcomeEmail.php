<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail implements ShouldQueue
{
    use Batchable,Queueable,InteractsWithQueue,Queueable,SerializesModels;

    #Naming conventions: Fiil + Nesne Yapısı
    # ör: Send + WelcomeEmail | ResetUserPassword
 
    
    #job bir defa çalıştırılır
    #public $tries = 1; 

    #tries until get success 
     public $tries = -1;


    #be sure that you install pcntl extension 
    # public $timeout = 5; 

    #seconds between each retry via time
    public $backoff = 2;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
       Log::debug("Welcome Email Construction Executed.");
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /*Business Logic executed here.
        sleep(3);
        Log::info("Handle Method Executed For." . self::class);

        */
     
        
         #sleep(10);
         

        Log::info("Handle method executed.");
       # throw new \Exception("Sth went wrong!");
        
    }

    public function failed(\Throwable $exception): void
    {
        // İş başarısız olduğunda hata mesajını loglara yazdırıyoruz.
        Log::error("Job failed due to: " . $exception->getMessage());
    }

    #tries for specific time, i.e: 60seconds, if it is over it will stop try it again.
    public function retryUntil(){
        return now()->addMinute();
    }
}
