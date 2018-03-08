<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        //
        $this->emial = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        //
        Mail::raw('duilieceshi', function ($message) {
            $message->to($this->email);
        });
        //
//        Log::info('yifasong' . $this->email);
    }
}
