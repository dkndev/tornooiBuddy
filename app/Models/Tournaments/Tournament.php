<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    //
    protected $table = 'tournaments';


    public function location()
    {
        return $this->belongsTo('App\Models\Tournaments\Location');
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\Tournaments\Contact');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Tournaments\Type');
    }

    public function rankings()
    {
        return $this->belongsToMany(
            'App\Models\Tournaments\Ranking',
            'tournaments_rankings',
            'tournament_id',
            'ranking_id')
            ->orderBy('ranking_id', 'asc');
    }


}
