<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;
    public $body;

    public function __construct($email, $body)
    {
        $this->email = $email;
        $this->body = $body;
    }

 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('back-end.mail.contactus');
    }
}
