<?php

namespace App\Listeners;

use App\Events\UserRegister;
use App\Jobs\VerifyAccountJob;
use App\Mail\VerifyAccountMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendVerifyEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle($event)
    {
        $email = $event->email;
        $hash = $event->hash;

        VerifyAccountJob::dispatch($email, $hash)
            ->delay(now()->addSeconds(3));
    }
}
