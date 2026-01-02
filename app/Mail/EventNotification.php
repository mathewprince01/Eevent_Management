<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $purchase;
    public function __construct($purchase)
    {
        return $this->purchase = $purchase;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Event Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'email.eventnotification',
            with:['purchase' => $this->purchase],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
