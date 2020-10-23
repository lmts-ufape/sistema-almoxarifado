<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    protected $fillable = ['nome', 'codigo', 'descricao', 'quantidade_minima'];
}
