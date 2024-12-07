<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EVStation;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    // Display a list of available slots
    public function options()
    {
        return view('admin.slots.options');
    }
    public function index(Request $request)
    {
        $query = Slot::with('evStation');

        // Apply filter if 'status' parameter is passed
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $slots = $query->paginate(7);  // Paginate results (10 per page)
        return view('admin.slots.index', compact('slots'));
    }

    public function createAuto()
    {
        $evStations = EVStation::all(); // Fetch all EV stations
        return view('admin.slots.create_auto', compact('evStations'));
    }


    public function generateSlots(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'ev_station_id' => 'required|exists:ev_stations,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'slot_duration' => 'required|integer|min:1|max:120', // Ensure it's an integer
        ]);

        // Retrieve validated data
        $evStationId = $validatedData['ev_station_id'];
        $date = $validatedData['date'];
        $startTime = $validatedData['start_time'];
        $endTime = $validatedData['end_time'];
        $slotDuration = (int) $validatedData['slot_duration'];  // Ensure it's an integer

        // Convert the date and times to Carbon instances
        $start = Carbon::parse("$date $startTime");
        $end = Carbon::parse("$date $endTime");

        // Generate slots based on the selected duration
        $slots = [];
        while ($start < $end) {
            $nextSlot = $start->copy()->addMinutes($slotDuration); // Add minutes as an integer
            if ($nextSlot > $end)
                break;

            $slots[] = [
                'ev_station_id' => $evStationId,
                'date' => $date,
                'start_time' => $start->format('H:i'),
                'end_time' => $nextSlot->format('H:i'),
                'status' => 'available',  // Default status as available
                'created_at' => now(),  // Add current timestamp for created_at
                'updated_at' => now(),  // Add current timestamp for updated_at
            ];

            $start = $nextSlot;
        }

        // Insert generated slots into the database
        Slot::insert($slots);

        return back()->with('success', 'Slots generated successfully!');
    }

    public function deleteOldSlots()
    {
        // Get today's date
        $today = now()->toDateString();

        // Delete all old available slots (status: available, date: before today)
        $deleted = Slot::where('status', 'available')
            ->where('date', '<', $today)
            ->delete();

        // Redirect with a success message
        return redirect()->route('admin.slots.index')->with('success', "{$deleted} old available slots deleted successfully.");
    }

    public function destroy($id)
    {
        $slot = Slot::findOrFail($id);
        $slot->delete();

        return redirect()->route('admin.slots.index')->with('success', 'Slot deleted successfully.');
    }

}
