<?php

namespace App\Http\Controllers;


use App\Models\Tournaments\Tournament;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::select('age', 'gender', 'postcode_id')
            ->where('id', '=', Auth::user()->id)
            ->with('location')
            ->limit(1)
            ->get();

        $ranking = User::select('rank_single','rank_dubbles','rank_mix')
            ->where('id', '=', Auth::user()->id)
            ->with('singleRank')
            ->with('dubbleRank')
            ->with('mixRank')
            ->limit(1)
            ->get();

//        unset($user->id);
//        unset($user->created_at);
//        dd($user);
        return view('tournament.index', [
            'user' => $user,
            'user_ranking'  => $ranking
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $t = Tournament::find($id);
        return view('tournament.show', [
            't' => $t
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
