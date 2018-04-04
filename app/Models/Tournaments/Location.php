<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    public function tournament(){
        return $this->hasMany('App\Models\Tournaments\Tournament');
    }
}
