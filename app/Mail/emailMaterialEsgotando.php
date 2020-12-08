<?php

namespace App\Mail;

use App\material;
use App\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailMaterialEsgotando extends Mailable
{
    use Queueable, SerializesModels;
    private $usuario;
    private $material;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Usuario $usuario, material $material)
    {
        $this->usuario = $usuario;
        $this->material = $material;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Um material atingiu um estado critico');
        $this->to($this->usuario->email, $this->usuario->nome);
        return $this->markdown('mail.emailMaterialEsgotando', [
            'usuario' => $this->usuario,
            'material' => $this->material
        ]);
    }
}
