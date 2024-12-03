<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;


class PaymentController extends Controller
{
    public function simulatePayment(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Simulate the payment by directly marking it as confirmed
        $booking->update(['status' => 'confirmed']);

        // Return a success message and redirect the user to the slot page
        return redirect()->route('ev.slots', $booking->slot->ev_station_id)
            ->with('success', 'Payment Successful and Booking Confirmed!');
    }

}
