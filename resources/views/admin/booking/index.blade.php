<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold mb-6 text-center">Manage OR View Bookings</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bookings Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Booking ID</th>
                        <th class="px-4 py-2 text-left">EV Station Name</th>
                        <th class="px-4 py-2 text-left">Car Brand</th>
                        <th class="px-4 py-2 text-left">Car Model</th>
                        <th class="px-4 py-2 text-left">Units</th>
                        {{-- <th class="px-4 py-2 text-left">Charge/Unit</th> --}}
                        <th class="px-4 py-2 text-left">Fare</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Start_time</th>
                        <th class="px-4 py-2 text-left">End_time</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $booking->id }}</td>
                            <td class="px-4 py-2">{{ $booking->slot->evStation->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $booking->car_brand }}</td>
                            <td class="px-4 py-2">{{ $booking->car_model }}</td>
                            <td class="px-4 py-2">{{ $booking->units }}</td>
                            {{-- <td class="px-4 py-2">{{ $booking->slot->evStation->price_per_unit ?? 'N/A' }}</td> --}}
                            <td class="px-4 py-2">₹{{ number_format($booking->fare, 2) }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->slot->date)->format('d M Y') }}</td>
                            {{-- <td class="px-4 py-2">{{ $booking->slot->date }}</td> --}}
                            <td class="px-4 py-2">{{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->slot->start_time)->format('h:i A') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->slot->end_time)->format('h:i A') }}</td>
                            {{-- <td class="px-4 py-2">{{ $booking->slot->start_time }}</td>
                            <td class="px-4 py-2">{{ $booking->slot->end_time }}</td> --}}
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-lg text-white text-sm {{ $booking->status === 'confirmed' ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <!-- Delete Button -->
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg shadow-md text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center px-4 py-2 text-gray-500">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
