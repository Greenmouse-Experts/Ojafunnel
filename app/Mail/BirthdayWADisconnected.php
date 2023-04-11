<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BirthdayWADisconnected extends Mailable
{
    use Queueable, SerializesModels;

    // birthday_automation
    public $birthday_automation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($birthday_automation)
    {
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
            subject: 'Birthday WhatsApp Disconnected',
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
            markdown: 'emails.wa.birthday_disconnected',
            with: [
                'birthday_automation' => $this->birthday_automation,
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
