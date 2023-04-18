<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class EmailCampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    //
    public $email_campaign;
    public $email_kit;
    public $email_template;
    public $contact;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_campaign, $email_kit, $email_template, $contact, $user)
    {
        $this->email_campaign = $email_campaign;
        $this->email_kit = $email_kit;
        $this->email_template = $email_template;
        $this->contact = $contact;
        $this->user = $user;
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
                new Address($this->email_campaign->replyto_email, $this->email_campaign->replyto_name),
            ],
            subject: $this->email_campaign->subject,
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
            view: 'emails.email-marketing-templates.' . $this->user->username . '.' . $this->email_template->slug,
            with: [
                'name' => $this->contact->name,
                'email' => $this->contact->email,
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
        $paths = json_decode($this->email_campaign->attachment_paths);
        $_attachments = [];

        for ($i = 0; $i < count($paths); $i++) {
            array_push($_attachments, Attachment::fromStorage('public/' . $paths[$i]));
        }

        return $_attachments;
    }
}
