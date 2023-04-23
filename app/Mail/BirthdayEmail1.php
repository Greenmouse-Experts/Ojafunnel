<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class BirthdayEmail1 extends Mailable
{
    use Queueable, SerializesModels;

    // message
    public $birthday_message;
    public $birthday_automation;
    public $email_kit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($birthday_message, $birthday_automation, $email_kit)
    {
        $this->birthday_message = $birthday_message;
        $this->birthday_automation = $birthday_automation;
        $this->email_kit = $email_kit;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->email_kit->from_email, $this->email_kit->from_name),
            replyTo: [
                new Address($this->email_kit->from_email, $this->email_kit->from_name),
            ],
            subject: 'Happy Birthday',
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
            markdown: 'emails.birthday.message',
            with: [
                'msg' => $this->birthday_message,
                'sender' => $this->birthday_automation->sender_name
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
