<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $fillable = ['material_id', 'estoque_id', 'mensagem', 'visto'];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id','id');
    }
}
