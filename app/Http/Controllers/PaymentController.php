<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Slot;

class PaymentController extends Controller
{

    // // Dummy payment processing method
    // public function processPayment(Request $request)
    // {
    //     // // Retrieve the data from the request
    //     // $slotId = $request->input('slot_id');
    //     // $fare = $request->input('fare');
    //     // $carModelId = $request->input('car_model');
    //     // $carNumber = $request->input('car_number');
    //     // $units = $request->input('units');
    //     // $carBrand = $request->input('car_brand');
    //     // Retrieve the booking ID and slot ID from the request
    //     $bookingId = $request->input('booking_id');

    //     // Find the booking
    //     $booking = Booking::findOrFail($bookingId);


    //     // Simulate payment success (For demo purpose, we can assume it's always successful)
    //     $paymentStatus = 'success'; // This can be dynamic if integrating real payment gateway

    //     if ($paymentStatus === 'success') {
    //         // Payment was successful, proceed with booking
    //         // Update the booking status to 'confirmed'
    //         $booking->update(['status' => 'confirmed']);

    //         // Update the slot status to 'booked'
    //         $slot = Slot::findOrFail($booking->slot_id);
    //         $slot->update(['status' => 'booked']);


    //         // Return success message
    //         return redirect()->route('booking.success', ['booking' => $booking->id])->with('success', 'Booking confirmed and payment successful!');
    //     } else {
    //         $booking->update(['status' => 'canceled']);
    //         // Handle payment failure
    //         $slot = Slot::findOrFail($booking->slot_id);
    //         $slot->update(['status' => 'available']);
    //         return back()->with('error', 'Payment failed! Please try again.');
    //     }
    // }


    public function bookingSuccess($bookingId)
    {
        $booking = Booking::with('slot.evStation')->findOrFail($bookingId);

        return view('booking.success', compact('booking'));
    }

    public function processPayment(Request $request)
    { $paymentId = $request->input('payment_id');
        $bookingId = $request->input('booking_id');
        $fare = $request->input('fare');

        // Update booking and slot statuses directly (skip verification)
        try {
            $booking = Booking::findOrFail($bookingId);

            // Update booking status to 'confirmed'
            $booking->update(['status' => 'confirmed']);

            // Update slot status to 'booked'
            $slot = Slot::findOrFail($booking->slot_id);
            $slot->update(['status' => 'booked']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }


    public function paymentSuccess(Request $request)
    {
        $paymentId = $request->input('payment_id');
        $bookingId = $request->input('booking_id');

        // Verify payment signature here if needed

        // Update booking status to 'confirmed'
        $booking = Booking::findOrFail($bookingId);
        $booking->update(['status' => 'confirmed']);

        // Update slot status to 'booked'
        $slot = Slot::findOrFail($booking->slot_id);
        $slot->update(['status' => 'booked']);

        return redirect()->route('booking.success', ['booking' => $booking->id])->with('success', 'Booking confirmed and payment successful!');
    }
}

