<?php

namespace App\Jobs;

use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subscriber;
    public $object;
    public $sender;


    public function __construct($subscriber, $object, $sender)
    {
        $this->subscriber = $subscriber;
        $this->object = $object;
        $this->sender = $sender;
        $this->onQueue('mail');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::mailer($this->sender->smtp)->to($this->sender->mail)->send(new ContactMail($this->subscriber, $this->object));
    }
}
