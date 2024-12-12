<?php

namespace App\Http\Controllers;

use App\Models\Station;
use DB;
use Illuminate\Http\Request;


class FuelStationController extends Controller
{

public function showNearbyFuelStations(Request $request)
{
    $userLatitude = $request->input('lat');
        $userLongitude = $request->input('lng');

        if (!$userLatitude || !$userLongitude) {
            return response()->json(["error" => "Invalid location data"]);
        }

        // Get nearby fuel stations using Eloquent and paginate
        $stations = Station::selectRaw("name, address, latitude, longitude,
        ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance",
            [$userLatitude, $userLongitude, $userLatitude]
        ) // Corrected longitude parameter
            ->having('distance', '<', 50)  // Limit the distance (50 km)
            ->orderBy('distance')
            ->paginate(10);  // Paginate 10 stations per page

    return view('fuel_stations.newFuelStations', [
        'stations' => $stations,
        'userLatitude' => $userLatitude,
        'userLongitude' => $userLongitude,
    ]);
}


}
