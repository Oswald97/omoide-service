<?php

namespace App\Providers;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Subscription
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $subscription;
    public $object;
    public $sender;

    public function __construct($message, $object, $sender)
    {
        $this->subscription = $message;
        $this->object = $object;
        $this->sender = $sender;
    }
}
