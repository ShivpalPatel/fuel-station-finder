<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slots Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6 text-center">Manage Slots</h2>

        <!-- Filter by Status -->
        <div class="mb-6 flex justify-between items-center">
            <form action="{{ route('admin.slots.index') }}" method="GET" class="flex gap-4">
                <label for="status" class="font-semibold">Filter by Status:</label>
                <select name="status" id="status" class="border rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                    <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </form>
        </div>

        <!-- Slots Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Station Name</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Start Time</th>
                        <th class="px-4 py-2 text-left">End Time</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slots as $slot)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $slot->evStation->name }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($slot->date)->format('d M Y') }}</td>
                            {{-- <td class="px-4 py-2">{{ $slot->date }}</td> --}}
                            <td class="px-4 py-2">{{ \Carbon\Carbon::createFromFormat('H:i:s', $slot->start_time)->format('h:i A') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::createFromFormat('H:i:s', $slot->end_time)->format('h:i A') }}</td>
                            {{-- <td class="px-4 py-2">{{ $slot->start_time }}</td> --}}
                            {{-- <td class="px-4 py-2">{{ $slot->end_time }}</td> --}}
                            <td class="px-4 py-2">
                                @if ($slot->status == 'available')
                                    <span class="text-green-500 font-semibold">Available</span>
                                @elseif ($slot->status == 'booked')
                                    <span class="text-red-500 font-semibold">Booked</span>
                                @else
                                    <span class="text-yellow-500 font-semibold">Canceled</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- No Slots Found Message -->
            @if ($slots->isEmpty())
                <p class="text-center py-4 text-gray-500">No slots found. Please add some slots.</p>
            @endif
        </div>

        <!-- Pagination with Filter Retained -->
        <div class="mt-4 text-white">
            {{ $slots->appends(['status' => request('status')])->links('pagination::tailwind') }}
        </div>

    </div>
</body>

</html>
