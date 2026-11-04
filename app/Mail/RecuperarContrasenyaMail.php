<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class RecuperarContrasenyaMail extends Mailable
{
    public function __construct(public string $enllac)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Recuperació de contrasenya');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.recuperar-contrasenya');
    }
}