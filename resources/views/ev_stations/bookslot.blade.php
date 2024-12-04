<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Slot</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Book Slot for {{ $evStation->name }}</h2>

        <form method="POST" action="{{ route('slots.book', $slot->id) }}">
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
</body>

</html>
