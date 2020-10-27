<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    // public function Material(){
    //     $this->belongsTo('app\material');
    // }
    protected $fillable = ['material_id', 'deposito_id', 'quantidade', 'codigo'];
}
