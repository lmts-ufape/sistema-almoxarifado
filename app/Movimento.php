<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    public function itemMovimentos(){
        $this->hasMany('App\itemMovimento');
    }
}
