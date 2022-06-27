<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VerifyAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hash;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($hash)
    {
        $this->hash = $hash;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $hash = $this->hash;

        return $this->view('auth.verify_email',compact('hash'));
    }
}
