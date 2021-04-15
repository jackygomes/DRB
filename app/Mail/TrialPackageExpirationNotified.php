<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrialPackageExpirationNotified extends Mailable
{
    use Queueable, SerializesModels;

    public $packageName;

    /**
     * Create a new message instance.
     *
     * @param $packageName
     */
    public function __construct($packageName)
    {
        $this->packageName = $packageName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.package');
    }
}
