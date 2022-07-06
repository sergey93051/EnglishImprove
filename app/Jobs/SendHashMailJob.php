<?php

namespace App\Jobs;

use App\Mail\SendHashMailForConfirmIp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendHashMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $hash;
    public $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email , $hash)
    {
        $this->hash = $hash;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new SendHashMailForConfirmIp($this->hash));
    }
}
