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

         // Validate the form inputs
         $request->validate([
             'car_brand' => 'required|exists:car_brands,id', // Car Brand ID validation
             'car_model' => 'required|exists:car_models,id', // Car Model ID validation
             'car_number' => 'required|string',
             'units' => 'required|integer|min:1',  // Validate units
         ]);

         // Find the car model and brand
         $carBrand = CarModel::findOrFail($request->car_brand); // Find car brand by ID
         $carModel = CarModel::findOrFail($request->car_model); // Find car model by ID

         // Calculate fare based on units
         $unitRate = 100;  // Example rate per unit (e.g., per hour or km)
         $fare = $request->units * $unitRate;

         // Update the slot to booked status
         $slot->update([
             'status' => 'booked',
             'car_model_id' => $carModel->id,
             'car_number' => $request->car_number,
             'units' => $request->units,  // Save units
             'fare' => $fare,  // Save fare
         ]);

         // Create a booking record with units
         Booking::create([
             'slot_id' => $slot->id,
             'car_model_id' => $carModel->id,
             'car_brand_id' => $carBrand->id,
             'car_number' => $request->car_number,
             'units' => $request->units,  // Store units in the booking
             'fare' => $fare,  // Store fare in the booking
             'status' => 'confirmed',
         ]);

         // Redirect with success message
         return redirect()->route('ev.slots', $slot->ev_station_id)
                          ->with('success', 'Booking Confirmed!');
     }


      public function confirmBooking($slotId, Request $request)
      {
          $slot = Slot::findOrFail($slotId);
          $evStation = $slot->evStation;  // Get the EV Station for the slot
          $carModels = CarModel::all(); // Get all car models

          // Calculate the fare (100 is an example rate per unit)
          $unitRate = 100;  // Unit rate
          $fare = $request->units * $unitRate; // Fare calculation

          // Return confirmation page with slot, station, car models, and calculated fare
          return view('booking.confirm', compact('slot', 'evStation', 'carModels', 'fare'));
      }

}
