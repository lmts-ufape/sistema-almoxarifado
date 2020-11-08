<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoStatus extends Model
{
    protected $fillable = ['status', 'observacao', 'receptor', 'solicitacao_id'];

    public function itemMovimentos(){
        $this->belongsTo('App\Solicitacao');
    }
}
