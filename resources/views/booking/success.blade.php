<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6">
            <h2 class="text-xl font-semibold">Booking Confirmed!</h2>
            <p>Your slot has been successfully booked. Below are your booking details:</p>
        </div>

        <!-- Booking Details -->
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Booking Details</h3>
            <p><strong>EV Station:</strong> {{ $booking->slot->evStation->name }}</p>

            <p><strong>Slot Time:</strong> {{ $booking->slot->start_time }} - {{ $booking->slot->end_time }}</p>
            <p><strong>Car:</strong> {{ $booking->car_brand }} - {{ $booking->car_model }}</p>
            <p><strong>Car Number:</strong> {{ $booking->car_number }}</p>
            <p><strong>Total Units:</strong> {{ $booking->units ?? 'N/A' }}</p>
            <p><strong>Total Fare:</strong> ₹{{ number_format($booking->fare, 2) }}</p>
            <p><strong>Payment ID:</strong> {{ $booking->payment_id }}</p>
        </div>

        <!-- Return Button -->
        <div class="mt-6">
            <a href="/" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Back to Home
            </a>
        </div>
    </div>
</body>

</html>
