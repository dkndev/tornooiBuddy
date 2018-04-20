<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'rankings';
    public $timestamps = false;

    public function tournament(){
        return $this->belongsToMany('App\Models\Tournaments\Tournament');
    }
}
