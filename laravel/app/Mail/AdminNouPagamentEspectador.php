<?php

namespace App\Mail;

use App\Models\Espectador;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNouPagamentEspectador extends Mailable {
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Espectador  
     */
    protected $espectador;
    protected $preu;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Espectador $espectador, $preu) {
        $this->espectador = $espectador;
        $this->preu = $preu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('Nou pagament ' . $this->espectador->name . ' ' . $this->espectador->name . ': ' . $this->preu . '€')
            ->markdown('emails.admin.nou-pagament')
            ->with([
                'nom' => $this->espectador->name,
                'cognoms' => $this->espectador->apellidos,
                'import' => $this->preu
            ]);
    }
}
