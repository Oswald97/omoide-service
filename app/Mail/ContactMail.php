<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;
    public $object;

    public function __construct($subscriber, $object = '')
    {
        $this->subscriber = $subscriber;
        $this->object = $object;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $render = $this->subject($this->object)->view('mails.contact');
        foreach ($this->subscriber->images as $image) {
            $filename = explode('/', $image)[1];
            $ext = explode('.', $filename)[1];
            $filename = explode('.', $filename)[0];
            $render->attachFromStorage($image, $this->subscriber->username . '-' . $filename . '.' . env('ATTACHMENT_FILE_EXT', $ext), [
                'mime' => 'image/' . env('ATTACHMENT_FILE_EXT', $ext)
            ]);
        }
        return $render;
    }
}
