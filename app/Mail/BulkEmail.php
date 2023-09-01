<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BulkEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $emailContent;
    public $emailTitle;
    /**
     * Create a new message instance.
     */
    public function __construct($emailContent, $emailTitle)
    {
        $this->emailContent = $emailContent;
        $this->emailTitle = $emailTitle;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Bulk Email',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.mail.bulk_email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->view('pages.mail.bulk_email')
            ->subject($this->emailTitle);
    }
}
