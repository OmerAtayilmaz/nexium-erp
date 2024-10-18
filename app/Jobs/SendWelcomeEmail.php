<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
       Log::debug("Welcome Email Will Be Sended.");
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /*Business Logic executed here.*/
        sleep(3);
        Log::info("Handle Method Executed For." . self::class);
    }
}
