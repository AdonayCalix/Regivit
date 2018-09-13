<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacionDate extends Mailable
{
    use Queueable, SerializesModels;

    public $start_date;
    public $end_date;


    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    public function build()
    {
        return $this->view('emails.notificacion_date')
            ->subject('ASIGNACION DE FECHA PARA LA SUBIDA DE DOCUMENTOS');
    }

}
