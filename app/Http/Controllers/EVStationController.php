<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CarModel;
use App\Models\EVStation;
use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EVStationController extends Controller
{
     // List EV Stations
     public function index()
     {
         $evStations = EVStation::all();
         return view('ev_stations.index', compact('evStations'));
     }

     // View Slots for a specific station
    public function viewSlots($id)
    {
        $evStation = EVStation::with('slots')->findOrFail($id);
        $carModels = CarModel::all();  // Get all car models
        return view('ev_stations.slots', compact('evStation','carModels'));
    }

     // Book a slot
     public function bookSlot(Request $request, $slotId)
{
    $slot = Slot::findOrFail($slotId);

    // Check if the slot is already booked
    if ($slot->status === 'booked') {
        return back()->with('error', 'This slot is already booked!');
    }

    // Validate the input
    $request->validate([
        'car_model' => 'required|exists:car_models,id',
        'units' => 'required|numeric|min:1',
    ]);

    // Get the car model selected by the user
    $carModel = CarModel::find($request->car_model);
    $units = $request->units;

    // Calculate the fare (price per unit * number of units)
    $fare = $carModel->price_per_unit * $units;

    // Store the booking
    $slot->status = 'booked';
    $slot->save();

    // Create the booking entry
    Booking::create([
        'slot_id' => $slot->id,
        'car_brand' => $carModel->brand,
        'car_model' => $carModel->model,
        'car_number' => $request->car_number,  // Assuming this input is collected as well
        'status' => 'confirmed',
    ]);

   // Redirect to payment page with calculated fare and slot details
   return view('payment.page', [
    'fare' => $fare,
    'slot' => $slot,
    'carModel' => $carModel,
    'carBrand' => $carModel->brand,
    'units' => $units,
    'carNumber' => $request->car_number
]);
}


    //   public function confirmBooking($slotId, Request $request)
    //   {
    //       $slot = Slot::findOrFail($slotId);
    //       $evStation = $slot->evStation;  // Get the EV Station for the slot
    //       $carModels = CarModel::all(); // Get all car models

    //       // Calculate the fare (100 is an example rate per unit)
    //       $unitRate = 100;  // Unit rate
    //       $fare = $request->units * $unitRate; // Fare calculation

    //       // Return confirmation page with slot, station, car models, and calculated fare
    //       return view('booking.confirm', compact('slot', 'evStation', 'carModels', 'fare'));
    //   }

}
