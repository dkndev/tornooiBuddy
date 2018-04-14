<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Postcode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $postcode
     * @return \Illuminate\Http\Response
     */
    public function show($postcode)
    {
        $location = Postcode::where('postcode',$postcode)->first();

        $json = json_encode($location);

        return response($json)
            ->withHeaders([
                'Content-Type' => 'application/json',
            ]);
    }
}
