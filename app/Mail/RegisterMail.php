<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    private $emailData, $hostName, $key;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData, $hostName, $key)
    {
        $this->emailData = $emailData;
        $this->hostName = $hostName;
        $this->key = $key;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscribers')
            ->with([
                'mailData' => $this->emailData, 'host_name' => $this->hostName, 'password' => $this->key
            ]);
    }
}
