<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        // $carModels  = CarModel::all();
        $carModels  = CarModel::paginate(9);
        return view('admin.cars.index', compact('carModels'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price_per_unit' => 'required|numeric',
        ]);

        CarModel::create($request->all());

        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully!');
    }

    public function edit($id)
    {
        $car = CarModel::find($id);
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price_per_unit' => 'required|numeric',
        ]);

        $car = CarModel::findOrFail($id);
        $car->update($request->all());


        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully!');
    }

    public function destroy( $id)
    {
        $car = CarModel::findOrFail($id);
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully!');
    }
}
