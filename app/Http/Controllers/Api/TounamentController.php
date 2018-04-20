<?php

namespace App\Http\Controllers\Api;

use App\Models\Tournaments\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tournament as TournamentRecources;
use App\Http\Resources\TournamentCollection;

class TounamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TournamentCollection
     */
    public function all()
    {
        $t = Tournament::all();
        return new TournamentCollection($t);
    }

    /**
     * Display a listing of the resource.
     *
     * @return TournamentCollection
     */

    /**
     * @param Request $request
     * @return array|null|string
     */
    public function filtert(Request $request)
    {
        $json = $request->json()->all();
        $max = [];
        $min = [];
        $max["lat"] = $json["filter"]["location"]["max"]["lat"];
        $max["lon"] = $json["filter"]["location"]["max"]["lon"];
        $min["lat"] = $json["filter"]["location"]["min"]["lat"];
        $min["lon"] = $json["filter"]["location"]["min"]["lon"];
        $startDate = $json["filter"]["date"]["start"];
        $endDate = $json["filter"]["date"]["end"];
        $t = Tournament::whereHas('location', function ($query) use ($max, $min) {
            $query->where('latitude', '<=', $max["lat"]);
            $query->where('longitude', '<=', $max["lon"]);
            $query->where('latitude', '>=', $min["lat"]);
            $query->where('longitude', '>=', $min["lon"]);
        })
            ->where('date_start', '>=', $startDate)
            ->where('date_end', '<=', $endDate)
            ->orderBy('date_start')->get();


//        $t = Tournament::has('location.latitude','>=',5)->get();
        return new TournamentCollection($t);
    }
}
