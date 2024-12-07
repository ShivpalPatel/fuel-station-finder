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
        <h2 class="text-2xl font-semibold mb-6 text-center">View & Manage Slots</h2>

        {{-- success message --}}
        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter by Status -->
        <div class="mb-6 flex justify-between items-center">
            <form action="{{ route('admin.slots.index') }}" method="GET" class="flex gap-4">
                <label for="status" class="font-semibold">Filter by Status:</label>
                <select name="status" id="status" class="border rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available
                    </option>
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
                        <th class="px-4 py-2 text-left">Action</th> <!-- New Action Column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slots as $slot)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $slot->evStation->name }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($slot->date)->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::createFromFormat('H:i:s', $slot->start_time)->format('h:i A') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::createFromFormat('H:i:s', $slot->end_time)->format('h:i A') }}</td>
                            <td class="px-4 py-2">
                                @if ($slot->status == 'available')
                                    <span class="text-green-500 font-semibold">Available</span>
                                @elseif ($slot->status == 'booked')
                                    <span class="text-red-500 font-semibold">Booked</span>
                                @else
                                    <span class="text-yellow-500 font-semibold">Canceled</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center"> <!-- Action Column -->
                                <form action="{{ route('admin.slots.deleteSingle', $slot->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    {{-- <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this slot?');">
                                        Delete
                                    </button> --}}
                                    <button
                                    type="submit"
                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600
                                           hover:bg-gradient-to-br focus:ring-4 focus:outline-none
                                           focus:ring-red-300 dark:focus:ring-red-800
                                           shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80
                                           font-medium rounded-lg text-sm px-5 py-2.5 text-center
                                           me-2 mb-2"
                                    onclick="return confirm('Are you sure you want to delete this slot?');">
                                    Delete
                                </button>
                                </form>
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


