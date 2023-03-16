<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeriesCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeSerie;
    public $idSerie;
    public $qtdTemporadas;
    public $episodiosPorTemporada;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $nomeSerie,
        $idSerie,
        $qtdTemporadas,
        $episodiosPorTemporada
    ) {
        $this->nomeSerie = $nomeSerie;
        $this->idSerie = $idSerie;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->episodiosPorTemporada = $episodiosPorTemporada;

        $this->subject = "Série $nomeSerie criada";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('mail.series-created');
        return $this->markdown('mail.series-created');
    }
}
