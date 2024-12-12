<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Confirm Payment for Slot Booking</h2>

        <!-- Booking Details -->
        <div class="bg-white p-4 shadow-md rounded-lg mb-6">
            <h3 class="text-xl font-semibold">EV Station: {{ $slot->evStation->name }}</h3>
            <p><strong>Slot Time:</strong> {{ $slot->start_time }} - {{ $slot->end_time }}</p>
            <p><strong>Car Model:</strong> {{ $carBrand }} - {{ $carModel->model }}</p>
            <p><strong>Car Number:</strong> {{ $carNumber }}</p>
            <p><strong>Total Units:</strong> {{ $units }}</p>
            <p><strong>Total Fare:</strong> ₹{{ number_format($fare, 2) }}</p>
        </div>

        <!-- Razorpay Payment Button -->
        <button id="rzp-button" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
            Pay with Razorpay
        </button>

        <!-- Razorpay Integration -->
        <script>
            var options = {
                "key": "{{ env('RAZORPAY_KEY_ID') }}",
                "amount": "{{ $fare * 100 }}", // Amount in paise (multiply by 100 for INR)
                "currency": "INR",
                "name": "EV Station Booking",
                "description": "Slot Booking Payment",
                "image": "https://your-logo-url.com/logo.png", // Optional
                "handler": function (response) {
                    // Handle successful payment
                    alert("Payment successful! Payment ID: " + response.razorpay_payment_id);

                    // Submit the payment details to the server
                    fetch("{{ route('payment.process') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            payment_id: response.razorpay_payment_id,
                            booking_id: "{{ $bookingId }}",
                            fare: "{{ $fare }}"
                        })
                    }).then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              window.location.href = "{{ route('booking.success', ['booking' => $bookingId]) }}";
                          } else {
                              alert("Payment processing failed. Please try again.");
                          }
                      });
                },
                "prefill": {
                    "name": "{{ auth()->user()->name }}",
                    "email": "{{ auth()->user()->email }}",
                    "contact": "9999999999" // Replace with user contact
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            document.getElementById('rzp-button').onclick = function (e) {
                rzp1.open();
                e.preventDefault();
            };
        </script>

    </div>
</body>

</html>




{{--
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Confirm Payment for Slot Booking</h2>

        <!-- Displaying the EV station and Slot details -->
        <div class="bg-white p-4 shadow-md rounded-lg mb-6">
            <h3 class="text-xl font-semibold">EV Station: {{ $slot->evStation->name }}</h3>
            <p><strong>Slot Time:</strong> {{ $slot->start_time }} - {{ $slot->end_time }}</p>
            <p><strong>Car Model:</strong> {{ $carBrand }} - {{ $carModel->model }}</p>
            <p><strong>Car Number:</strong> {{ $carNumber }}</p>
            <p><strong>Total Units:</strong> {{ $units }}</p>
            <p><strong>Total Fare:</strong> ₹{{ number_format($fare, 2) }}</p>
        </div>

        <!-- Payment Form -->
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-xl font-semibold mb-4">Make Payment</h3>
            <form method="POST" action="{{ route('payment.process') }}">
                @csrf

                <!-- Payment Details (this is where Razorpay or dummy payment integration will happen) -->
                <div class="mb-4">
                    <label for="payment_method" class="block font-semibold">Select Payment Method</label>
                    <select id="payment_method" name="payment_method" class="border rounded px-3 py-2 w-full">
                        <option value="razorpay">Razorpay</option>
                        <option value="dummy">Dummy Payment</option>
                    </select>
                </div>

                <!-- Hidden inputs for storing the data -->
                <input type="hidden" name="booking_id" value="{{ $bookingId }}">
                <input type="hidden" name="slot_id" value="{{ $slot->id }}">
                <input type="hidden" name="fare" value="{{ $fare }}">
                <input type="hidden" name="car_number" value="{{ $carNumber }}">
                <input type="hidden" name="units" value="{{ $units }}">
                <input type="hidden" name="car_model" value="{{ $carModel->id }}">
                <input type="hidden" name="car_brand" value="{{ $carBrand }}">

                <!-- Payment Button -->
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Proceed to Payment
                </button>

            </form>
        </div>
    </div>
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

</body>

</html> --}}
