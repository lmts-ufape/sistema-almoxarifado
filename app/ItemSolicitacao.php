<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemSolicitacao extends Model
{
    public function movimento(){
        $this->belongsTo('App\Solicitacao');
    }
}
