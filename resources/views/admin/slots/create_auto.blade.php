<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Automatic Slots</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6 text-center">Create Automatic Slots</h2>

        <!-- Success Modal -->
        @if(session('success'))
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 text-center">
                    <h3 class="text-xl font-semibold text-green-600">{{ session('success') }}</h3>
                    <button id="closeModal" class="mt-4 bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600">
                        OK
                    </button>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.slots.generate') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg space-y-6">
            @csrf

            <!-- EV Station Selection -->
            <div>
                <label for="ev_station" class="block font-semibold text-gray-700">Select EV Station</label>
                <select name="ev_station_id" id="ev_station" class="border rounded px-3 py-2 w-full" required>
                    <option value="">Select EV Station</option>
                    @foreach ($evStations as $station)
                        <option value="{{ $station->id }}">{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date Field -->
            <div>
                <label for="date" class="block font-semibold text-gray-700">Start Date</label>
                <input type="date" name="date" id="date" class="border rounded px-3 py-2 w-full" value="{{ now()->toDateString() }}" required>
            </div>

            <!-- Number of Days -->
            <div>
                <label for="days" class="block font-semibold text-gray-700">Number of Days</label>
                <input type="number" name="days" id="days" class="border rounded px-3 py-2 w-full" value="1" min="1" required>
            </div>

            <!-- Time Range -->
            <div class="flex gap-4">
                <div>
                    <label for="start_time" class="block font-semibold text-gray-700">Start Time</label>
                    <input type="time" name="start_time" id="start_time" class="border rounded px-3 py-2 w-full" required>
                </div>
                <div>
                    <label for="end_time" class="block font-semibold text-gray-700">End Time</label>
                    <input type="time" name="end_time" id="end_time" class="border rounded px-3 py-2 w-full" required>
                </div>
            </div>

            <!-- Slot Duration -->
            <div>
                <label for="slot_duration" class="block font-semibold text-gray-700">Slot Duration (minutes)</label>
                <input type="number" name="slot_duration" id="slot_duration" class="border rounded px-3 py-2 w-full" placeholder="E.g., 30" min="5" max="120" required>
            </div>

            <!-- Preview Slots Button -->
            <div class="flex justify-end">
                <button type="button" onclick="previewSlots()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md">
                    Preview Slots
                </button>
            </div>

            <!-- Preview Area -->
            <div class="bg-gray-100 p-4 rounded-lg mt-4" id="preview-container">
                <h3 class="text-lg font-semibold mb-2">Slot Preview:</h3>
                <div id="slot-preview" class="space-y-2 text-gray-700"></div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow-md">
                    Generate Slots
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewSlots() {
            const stationName = document.getElementById('ev_station').options[document.getElementById('ev_station').selectedIndex].text;
            const stationId = document.getElementById('ev_station').value;
            const date = document.getElementById('date').value;
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;
            const slotDuration = document.getElementById('slot_duration').value;

            if (!stationId || !date || !startTime || !endTime || !slotDuration) {
                alert('Please fill in all fields.');
                return;
            }

            const previewContainer = document.getElementById('slot-preview');
            previewContainer.innerHTML = ''; // Clear previous previews

            const start = new Date(`${date}T${startTime}`);
            const end = new Date(`${date}T${endTime}`);
            const duration = parseInt(slotDuration);

            while (start < end) {
                const nextSlot = new Date(start.getTime() + duration * 60000);
                if (nextSlot > end) break;

                const slotElement = document.createElement('div');
                slotElement.textContent = `Date: ${date} | ${stationName} - ${start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} to ${nextSlot.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;
                slotElement.className = 'bg-gray-200 p-2 rounded my-2';
                previewContainer.appendChild(slotElement);

                start.setTime(nextSlot.getTime());
            }
        }

        // Close modal functionality
        document.getElementById('closeModal')?.addEventListener('click', () => {
            document.querySelector('.fixed').style.display = 'none';
        });
    </script>
</body>
</html>
