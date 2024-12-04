<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Slot;

class PaymentController extends Controller
{

    // Dummy payment processing method
    public function processPayment(Request $request)
    {
        // Retrieve the data from the request
        $slotId = $request->input('slot_id');
        $fare = $request->input('fare');
        $carModelId = $request->input('car_model');
        $carNumber = $request->input('car_number');
        $units = $request->input('units');
        $carBrand = $request->input('car_brand');

        // Simulate payment success (For demo purpose, we can assume it's always successful)
        $paymentStatus = 'success'; // This can be dynamic if integrating real payment gateway

        if ($paymentStatus === 'success') {
            // Payment was successful, proceed with booking
            $booking = Booking::create([
                'slot_id' => $slotId,
                'car_brand' => $carBrand,
                'car_model' => $carModelId,
                'car_number' => $carNumber,
                'status' => 'confirmed',
            ]);

            // Update the slot status to 'booked'
            $slot = Slot::findOrFail($slotId);
            $slot->status = 'booked';
            $slot->save();

            // Return success message
            return redirect()->route('booking.success', ['booking' => $booking->id])->with('success', 'Booking confirmed and payment successful!');
        } else {
            // Handle payment failure
            return back()->with('error', 'Payment failed! Please try again.');
        }
    }

    public function simulatePayment(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Simulate the payment by directly marking it as confirmed
        $booking->update(['status' => 'confirmed']);

        // Return a success message and redirect the user to the slot page
        return redirect()->route('ev.slots', $booking->slot->ev_station_id)
            ->with('success', 'Payment Successful and Booking Confirmed!');
    }
    public function confirmPayment(Request $request, $slotId)
    {
        $slot = Slot::findOrFail($slotId);

        // Check if the slot is already booked
        if ($slot->status === 'booked') {
            return redirect()->back()->with('error', 'This slot is already booked!');
        }

        // Update slot status to booked
        $slot->update(['status' => 'booked']);

        // Create a booking record
        Booking::create([
            'slot_id' => $slot->id,
            'car_brand' => $request->car_brand,
            'car_model' => $request->car_model,
            'car_number' => $request->car_number,
            'units' => $request->units,
            'status' => 'confirmed',
        ]);

        return redirect()->route('ev.slots', $slot->ev_station_id)->with('success', 'Slot booked successfully!');
    }

}
