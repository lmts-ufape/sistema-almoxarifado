<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = ['material_id', 'deposito_id', 'quantidade', 'codigo'];
}
