<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VerifyAccountEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
    public $hash;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $email , string $hash)
    {
        $this->email = $email;
        $this->hash = $hash;
    }

}
