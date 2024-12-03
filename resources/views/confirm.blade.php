<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Confirm Your Booking</h2>

        <!-- Booking Details -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Booking Details</h3>
            <p><strong>Fuel Station:</strong> {{ $evStation->name }}</p>
            <p><strong>Slot:</strong> {{ $slot->date }} | {{ $slot->start_time }} - {{ $slot->end_time }}</p>

            <h3 class="text-xl font-semibold mb-4 mt-6">Car Details</h3>
            <p><strong>Car Model:</strong> {{ $request->car_model }}</p>
            <p><strong>Car Number:</strong> {{ $request->car_number }}</p>

            <h3 class="text-xl font-semibold mb-4 mt-6">Units</h3>
            <p><strong>Total Units:</strong> {{ $request->units }}</p>
            <p><strong>Fare:</strong> ₹{{ number_format($fare, 2) }}</p>

        </div>

        <!-- Payment Button -->
        <form action="{{ route('payment.simulate', $slot->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Confirm and Pay
            </button>
        </form>
    </div>
</body>

</html>
