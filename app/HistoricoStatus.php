<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoStatus extends Model
{
    public function itemMovimentos(){
        $this->belongsTo('App\Solicitacao');
    }
}
