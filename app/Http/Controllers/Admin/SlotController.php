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

        $slots = $query->paginate(10);  // Paginate results (10 per page)
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
        if ($nextSlot > $end) break;

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


    // public function generateSlots(Request $request)
    // {
    //     // Validate the request data
    //     $validated = $request->validate([
    //         'ev_station_id' => 'required',
    //         'date' => 'required|date',
    //         'days' => 'required|integer|min:1',
    //         'start_time' => 'required|date_format:H:i',
    //         'end_time' => 'required|date_format:H:i',
    //         'slot_duration' => 'required|integer|min:5|max:120',
    //     ]);

    //     // Retrieve the selected station and slot details
    //     $station = EVStation::findOrFail($request->ev_station_id);
    //     $start = \Carbon\Carbon::parse($request->date . ' ' . $request->start_time);
    //     $end = \Carbon\Carbon::parse($request->date . ' ' . $request->end_time);
    //     $duration = $request->slot_duration;

    //     // Check if there are any overlapping slots in the database
    //     $existingSlots = Slot::where('ev_station_id', $station->id)
    //         ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
    //         ->where(function ($query) use ($start, $end) {
    //             $query->whereBetween('start_time', [$start->toTimeString(), $end->toTimeString()])
    //                 ->orWhereBetween('end_time', [$start->toTimeString(), $end->toTimeString()]);
    //         })->get();

    //     if ($existingSlots->count() > 0) {
    //         return back()->with('error', 'Some slots overlap with existing bookings. Please adjust the time range.');
    //     }

    //     // Generate slots and store them in the database
    //     $slots = [];
    //     for ($i = 0; $i < $request->days; $i++) {
    //         $currentDate = $start->addDays($i); // Adjust date for each day
    //         while ($currentDate < $end) {
    //             $slotEnd = $currentDate->copy()->addMinutes($duration);
    //             if ($slotEnd > $end) break;

    //             $slots[] = Slot::create([
    //                 'ev_station_id' => $station->id,
    //                 'date' => $currentDate->toDateString(),
    //                 'start_time' => $currentDate->format('H:i'),
    //                 'end_time' => $slotEnd->format('H:i'),
    //                 'status' => 'available',  // Default to available
    //             ]);
    //             $currentDate = $slotEnd;
    //         }
    //     }

    //     return redirect()->route('admin.slots.index')->with('success', 'Slots generated successfully!');
    // }


    public function previewSlots(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'ev_station_id' => 'required',
            'date' => 'required|date',
            'days' => 'required|integer|min:1',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'slot_duration' => 'required|integer|min:5|max:120',
        ]);

        // Retrieve the selected station and slot details
        $station = EVStation::findOrFail($request->ev_station_id);
        $start = \Carbon\Carbon::parse($request->date . ' ' . $request->start_time);
        $end = \Carbon\Carbon::parse($request->date . ' ' . $request->end_time);
        $duration = $request->slot_duration;

        // Generate slots for preview
        $slots = [];
        for ($i = 0; $i < $request->days; $i++) {
            $currentDate = $start->addDays($i); // Adjust date for each day
            while ($currentDate < $end) {
                $slotEnd = $currentDate->copy()->addMinutes($duration);
                if ($slotEnd > $end)
                    break;

                $slots[] = [
                    'start' => $currentDate->format('H:i'),
                    'end' => $slotEnd->format('H:i'),
                ];
                $currentDate = $slotEnd;
            }
        }

        return view('admin.slots.preview', compact('slots', 'station', 'request'));
    }


    public function deleteOldSlots(Request $request)
    {
        // Validate the date
        $validated = $request->validate([
            'date' => 'required|date',
        ]);

        // Delete old available slots for the selected date
        Slot::where('date', $request->date)->where('status', 'available')->delete();

        return redirect()->route('admin.slots.create-auto')->with('success', 'Old available slots deleted successfully!');
    }



}
