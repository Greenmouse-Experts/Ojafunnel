<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\UploadedFile;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $attachment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message, UploadedFile $attachment)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->attachment = $attachment;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */

    public function build()
    {
    $mail = $this->markdown('emails.newsletter')
            ->with('message', $this->message);

        if ($this->attachment) {
            $filename = $this->attachment->getClientOriginalName();

            // Store the file in the storage disk
            $filePath = $this->attachment->storeAs('attachment', $filename, 'public');

            // Get the absolute path of the stored file
            $absolutePath = storage_path('app/public/' . $filePath);

            // Attach the file to the email using the absolute path
            $mail->attach($absolutePath, [
                'as' => $filename,
                'mime' => $this->attachment->getMimeType(),
            ]);
        }

        return $mail;
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
