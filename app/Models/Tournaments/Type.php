<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

    public function tournament(){
        return $this->hasMany('App\Models\Tournaments\Tournament');
    }
}
