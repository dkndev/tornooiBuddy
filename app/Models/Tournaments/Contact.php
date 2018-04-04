<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';


    public function tournament(){
        return $this->hasMany('App\Models\Tournaments\Tournament');
    }
}
