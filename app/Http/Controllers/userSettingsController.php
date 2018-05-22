<?php

namespace App\Http\Controllers;

use App\Models\Tournaments\Ranking;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userSettingsController extends Controller
{
    /**
     * userSettingsController constructor.
     */
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
        $user = User::select('birthday', 'gender', 'postcode_id')
            ->where('id', '=', Auth::user()->id)
            ->with('location')
            ->limit(1)
            ->get();

        $user = User::find(Auth::user()->id);

        $ranking = User::select('rank_single', 'rank_dubbles', 'rank_mix')
            ->where('id', '=', Auth::user()->id)
            ->with('singleRank')
            ->with('dubbleRank')
            ->with('mixRank')
            ->limit(1)
            ->get();

        $rankingOptions = Ranking::all();
        $rankingOptions = json_encode($rankingOptions);
        return view('user-dashboard.settings', [
            'user' => $user,
            'ranking' => $ranking,
            'rankingOptions' => $rankingOptions
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
        //
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
