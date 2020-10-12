<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model {

    // protected $fillable = ['nome', 'codigo'];

    protected $table = 'depositos';

    public function estoques(){
        $this->hasMany('App\Estoque');
    }
}
