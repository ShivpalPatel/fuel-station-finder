

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2>Payment for Booking {{ $booking->id }}</h2>

        <!-- Simulate payment button -->
        <form action="{{ route('payment.simulate', $booking->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simulate Payment
            </button>
        </form>
    </div>
</body>

</html>
