<?php

namespace App\Http\Controllers;

use Modules\Trip\Models\Trip;

class SubStationsController extends Controller
{
    public function show(Trip $trip)
    {


        // dd($trip->stations['name']);

        return view('updateStations', compact('trip'));
    }
}
