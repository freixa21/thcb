<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNouRegistre extends Mailable
{
    use Queueable, SerializesModels;

    protected $inscripcio;
    protected $nom;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inscripcio, $nom) {
        $this->inscripcio = $inscripcio;
        $this->nom = $nom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('Nova inscripció ' . $this->inscripcio . ': ' . $this->nom)
        ->markdown('emails.admin.nou-registre')
        ->with([
            'inscripcio' => $this->inscripcio,
            'nom' => $this->nom
        ]);
    }
}
