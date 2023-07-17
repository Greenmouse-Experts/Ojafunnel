<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ListCreationNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $_subject;
    public $_content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_subject, $_content)
    {
        $this->_subject = $_subject;
        $this->_content = $_content;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->_subject,
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
            markdown: 'emails.storefront.notify',
            with: [
                '_subject' => $this->_subject,
                '_content' => $this->_content
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
