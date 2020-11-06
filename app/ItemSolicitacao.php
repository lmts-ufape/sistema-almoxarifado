<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemSolicitacao extends Model
{
    protected $fillable = ['quantidade_solicitada', 'quantidade_aprovada', 'material_id', 'solicitacao_id'];

    public function movimento(){
        $this->belongsTo('App\Solicitacao');
    }
}
