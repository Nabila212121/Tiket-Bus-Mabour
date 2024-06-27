<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $pdf;
    public $subject;
    public $messageText;
    public function __construct($pdf, $subject = "Tiket", $message = "Terima kasih telah menggunakan layanan kami.")
    {
        $this->pdf = $pdf;
        $this->subject = $subject;
        $this->messageText = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.send-email',
            with: [
                'message' => $this->messageText,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->pdf) {
            return [
                Attachment::fromData(function(){
                    return $this->pdf;
                },'tiket.pdf')
            ];
        }
        return [];
    }
}
