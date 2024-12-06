<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slot Preview</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6 text-center">Slot Preview for {{ $station->name }}</h2>

        <!-- Display Slot Preview -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-2">Selected Date: {{ $request->date }}</h3>
            <h3 class="text-lg font-semibold mb-2">Time Range: {{ $request->start_time }} - {{ $request->end_time }}</h3>
            <h3 class="text-lg font-semibold mb-2">Slot Duration: {{ $request->slot_duration }} minutes</h3>

            <!-- Slot List -->
            <div class="mt-4">
                <h4 class="text-lg font-semibold mb-2">Generated Slots:</h4>
                <ul class="list-disc pl-5">
                    @foreach ($slots as $slot)
                        <li>{{ $slot['start'] }} - {{ $slot['end'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex justify-between">
            <form action="{{ route('admin.slots.generate') }}" method="POST" class="inline-block">
                @csrf
                <input type="hidden" name="ev_station_id" value="{{ $request->ev_station_id }}">
                <input type="hidden" name="da   te" value="{{ $request->date }}">
                <input type="hidden" name="days" value="{{ $request->days }}">
                <input type="hidden" name="start_time" value="{{ $request->start_time }}">
                <input type="hidden" name="end_time" value="{{ $request->end_time }}">
                <input type="hidden" name="slot_duration" value="{{ $request->slot_duration }}">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg">Generate Slots</button>
            </form>
            <a href="{{ route('admin.slots.create-auto') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg">Back</a>
        </div>
    </div>
</body>
</html>
