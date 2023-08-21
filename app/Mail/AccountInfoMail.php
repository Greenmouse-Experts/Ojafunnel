<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;
    public $email_message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password, $email_message)
    {
        $this->email = $email;
        $this->password = $password;
        $this->email_message = $email_message;
    }

    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user-information');
    }
}
