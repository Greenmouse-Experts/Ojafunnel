<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $names;
    public $message;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($names, $message, $title)
    {
        $this->names = $names;
        $this->message = $message;
        $this->title = $title;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->title,
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
            markdown: 'emails.notify_user',
            with: [
                'page'  => 'list_mgt',
                'message' => $this->message,
                'user' => $this->names
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
