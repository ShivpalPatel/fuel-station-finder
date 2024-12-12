<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CarModel;
use App\Models\EVStation;
use App\Models\Slot;
use Illuminate\Http\Request;
use Razorpay\Api\Api;


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
        'car_model' => 'required',
        'units' => 'required|numeric|min:1',
        'car_number' => 'required'
    ]);

    // Get the car model selected by the user
    $carModel = CarModel::find($request->car_model);
    $units = $request->units;

    // Calculate the fare (price per unit * number of units)
    $fare = $carModel->price_per_unit * $units;

     $booking =  Booking::create([
        'slot_id' => $slot->id,
        'user_id' => auth()->id(), // Assign the logged-in user's ID
        'car_brand' => $carModel->brand,
        'car_model' => $carModel->model,
        'car_number' => $request->car_number,
        'status' => 'pending',
         'fare' => $fare,
         'units'=> $units
    ]);


    // Initialize Razorpay API
    $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

    // Create Razorpay order
    $orderData = [
        'receipt'         => 'order_rcptid_' . $booking->id,
        'amount'          => $fare * 100, // Amount in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // Auto capture
    ];

    $razorpayOrder = $api->order->create($orderData);
    // dd(vars: env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

    // Pass order ID to the view
    return view('payment.page', [
        'fare' => $fare,
        'slot' => $slot,
        'carModel' => $carModel,
        'carBrand' => $carModel->brand,
        'units' => $units,
        'carNumber' => $request->car_number,
        'bookingId' => $booking->id,
        'order_id' => $razorpayOrder['id'], // Pass the Razorpay order ID
        'razorpay_key' => env('RAZORPAY_KEY_ID'), // Pass the Razorpay Key to Blade
    ]);

    // before razpr pay
    // // Redirect to payment page with calculated fare and slot details
    //  return view('payment.page', [
    // 'fare' => $fare,
    // 'slot' => $slot,
    // 'carModel' => $carModel,
    // 'carBrand' => $carModel->brand,
    // 'units' => $units,
    // 'carNumber' => $request->car_number,
    // 'bookingId' => $booking->id, // Pass the booking ID

    //  ]);
 }

 // user personal bookings
 public function userPersonalBookings()
 {
    $user = auth()->user(); // Get the currently logged-in user
    $bookings = Booking::where('user_id', $user->id)->with('slot.evStation')->paginate(10);

    return view('user.bookings', compact('bookings'));
 }
}
