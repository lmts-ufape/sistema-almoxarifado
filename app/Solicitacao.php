<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    public function itensSolicitacoes(){
        $this->hasMany('App\ItemSolicitacao');
    }

    public function historicoStatus(){
        $this->hasMany('App\HistoricoStatus');
    }
}
