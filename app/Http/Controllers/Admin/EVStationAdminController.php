<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EVStation;
use Illuminate\Http\Request;

class EVStationAdminController extends Controller
{


    public function index()
    {
        $evStations = EVStation::all();
        return view('admin.ev-stations.index', compact('evStations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ev-stations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        EVStation::create($request->all());

        return redirect()->route('admin.ev-stations.index')->with('success', 'EV Station added successfully!');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evStation = EVStation::find($id);
        return view('admin.ev-stations.edit', compact('evStation'));
    }


    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Find the EV Station by ID
        $evStation = EVStation::findOrFail($id);

        // Update the EV Station
        $evStation->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        // Redirect with success message
        return redirect()->route('admin.ev-stations.index')->with('success', 'EV Station updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evStation = EVStation::findOrFail($id);
        $evStation->delete();
        return redirect()->route('admin.ev-stations.index')->with('success', 'EV Station deleted successfully!');

    }
}
