<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Api\Postcode', 'postcode_id', 'id');
    }

    public function singleRank()
    {
        return $this->belongsTo('App\Models\Tournaments\Ranking', 'rank_single');
    }

    public function dubbleRank()
    {
        return $this->belongsTo('App\Models\Tournaments\Ranking', 'rank_dubbles');
    }

    public function mixRank()
    {
        return $this->belongsTo('App\Models\Tournaments\Ranking', 'rank_mix');
    }
}
