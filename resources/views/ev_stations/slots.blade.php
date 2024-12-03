<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV Slots</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Slots for {{ $evStation->name }}</h2>

        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter Options -->
        <div class="mb-4">
            <label for="filter" class="font-semibold">Filter Slots:</label>
            <select id="filter" class="border rounded px-2 py-1">
                <option value="all">All Slots</option>
                <option value="available">Available Only</option>
                <option value="booked">Booked Only</option>
            </select>
        </div>

        <!-- Slots Table -->
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Start Time</th>
                    <th class="px-4 py-2">End Time</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody id="slot-list">
                @foreach ($evStation->slots as $slot)
                    <tr class="border-b slot-row @if ($slot->status === 'booked') bg-red-100 @else bg-green-100 @endif" data-status="{{ $slot->status }}">
                        <td class="px-4 py-2">{{ $slot->date }}</td>
                        <td class="px-4 py-2">{{ $slot->start_time }}</td>
                        <td class="px-4 py-2">{{ $slot->end_time }}</td>
                        <td class="px-4 py-2">
                            @if ($slot->status === 'booked')
                                <span class="text-red-500 font-semibold">Booked</span>
                            @else
                                <span class="text-green-500 font-semibold">Available</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if ($slot->status === 'available')
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="openBookingModal({{ $slot->id }})">
                                    Book Now
                                </button>
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Booking Slot -->
    <div id="bookingModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-semibold mb-4">Book Slot</h3>
            <form id="bookingForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="car_model" class="block font-semibold">Car Model</label>
                    <select name="car_model" id="car_model" class="border rounded px-3 py-2 w-full">
                        <option value="">Select Model</option>
                        @foreach($carModels as $car)
                            <option value="{{ $car->id }}">{{ $car->brand }} - {{ $car->model }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="car_number" class="block font-semibold">Car Number</label>
                    <input type="text" name="car_number" id="car_number" class="border rounded px-3 py-2 w-full" placeholder="Enter Car Number">
                </div>
                <div class="mb-4">
                    <label for="units" class="block font-semibold">Units</label>
                    <input type="number" name="units" id="units" class="border rounded px-3 py-2 w-full" min="1" required>
                </div>
                <div class="flex justify-between">
                    <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const bookingModal = document.getElementById('bookingModal');
        const bookingForm = document.getElementById('bookingForm');
        const closeModal = document.getElementById('closeModal');
        const filterSelect = document.getElementById('filter');
        const slotList = document.getElementById('slot-list');

        // Handle Filter Change
        filterSelect.addEventListener('change', function () {
            const selectedFilter = this.value;
            const slots = document.querySelectorAll('.slot-row');

            slots.forEach(function (slot) {
                const slotStatus = slot.getAttribute('data-status');
                if (selectedFilter === 'all' || slotStatus === selectedFilter) {
                    slot.style.display = '';
                } else {
                    slot.style.display = 'none';
                }
            });
        });

        function openBookingModal(slotId) {
            bookingForm.action = `/slots/${slotId}/book`; // Set the form action dynamically
            bookingModal.classList.remove('hidden');
        }

        closeModal.addEventListener('click', () => {
            bookingModal.classList.add('hidden');
        });
    </script>
</body>

</html>
