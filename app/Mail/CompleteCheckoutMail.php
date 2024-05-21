<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompleteCheckoutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $checkout,$user;

    public function __construct($checkout,$user)
    {
        $this->checkout = $checkout;
        $this->user = $user;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thanks to Choose Our Store',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Mail.CompleteCheckoutMail',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
