<?php

namespace App\Providers;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class SendMail
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
     * @param  Subscription  $event
     * @return void
     */
    public function handle(Subscription $event)
    {
        Mail::mailer($event->sender->smtp)->to($event->sender->mail)->send(new ContactMail($event->subscription, $event->object));
    }
}
