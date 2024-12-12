@extends('layouts.user')

@section('content')
   <!-- user/bookings/index.blade.php -->

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-6 text-center">My Bookings</h2>

    @if($bookings->isEmpty())
        <p class="text-center text-gray-500">You have no bookings yet.</p>
    @else
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Station Name</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Start Time</th>
                    <th class="px-4 py-2">End Time</th>
                    <th class="px-4 py-2">Car Brand</th>
                    <th class="px-4 py-2">Car Model</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Fare</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $booking->slot->evStation->name }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->slot->date)->format('d M Y') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->slot->start_time)->format('h:i A') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->slot->end_time)->format('h:i A') }}</td>
                        <td class="px-4 py-2">{{ $booking->car_brand }}</td>
                        <td class="px-4 py-2">{{ $booking->car_model }}</td>
                        <td class="px-4 py-2">
                            @if($booking->status == 'confirmed')
                                <span class="text-green-500">Confirmed</span>
                            @elseif($booking->status == 'pending')
                                <span class="text-yellow-500">Pending</span>
                            @else
                                <span class="text-red-500">Canceled</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ number_format($booking->fare, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
