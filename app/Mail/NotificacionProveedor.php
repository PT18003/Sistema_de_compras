<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DetalleRequisicion;


class NotificacionProveedor extends Mailable
{
    use Queueable, SerializesModels;
    public $ordenPedido;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //public function __construct(DetalleRequisicion $ordenPedido)
    public function __construct()
    {
        //
       // $this->$ordenPedido = $ordenPedido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.notificacionProveedor');
    }
}
