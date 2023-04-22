<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class BirthdayEmail extends Mailable
{
    use Queueable, SerializesModels;

    // message
    public $birthday_message;
    public $birthday_automation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($birthday_message, $birthday_automation)
    {
        $this->birthday_message = $birthday_message;
        $this->birthday_automation = $birthday_automation; 
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->birthday_automation->sms_type == 'birthday' ? 'Happy Birthday' : 'Happy Anniversary',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: $this->birthday_automation->sms_type == 'birthday' ? 'emails.birthday.message' : 'emails.birthday.message-2',
            with: [
                'message' => $this->birthday_message,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
