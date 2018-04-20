<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    protected $table = 'postcodes';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user(){
        return $this->hasMany('App\Models\Users\user');
    }
}
