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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $t = Tournament::all();
        return new TournamentCollection($t);
    }
}
