<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemMovimento extends Model
{
    public function movimento(){
        $this->belongsTo('App\Movimento');
    }
}
