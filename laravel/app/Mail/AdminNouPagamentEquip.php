<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNouPagamentEquip extends Mailable {
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Espectador  
     */
    protected $nom;
    protected $preu;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom, $preu) {
        $this->nom = $nom;
        $this->preu = $preu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('Nou pagament EQUIP: ' . $this->nom . ': ' . $this->preu . '€')
            ->markdown('emails.admin.nou-pagament-equip')
            ->with([
                'nom' => $this->nom,
                'import' => $this->preu
            ]);
    }
}
