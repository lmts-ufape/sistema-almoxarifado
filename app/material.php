<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class material extends Model
{
    use SoftDeletes;
    protected $fillable = ['nome', 'codigo', 'descricao', 'quantidade_minima', 'imagem'];
}
