<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Slots</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- Main Container -->
    <div class="min-h-screen flex justify-center items-center">
        <div class="text-center space-y-6 bg-white p-10 rounded-lg shadow-xl w-full sm:w-96">

            <h2 class="text-2xl font-semibold text-gray-800">Manage EV Slots</h2>

            <!-- Buttons -->
            <div class="space-y-4">
                <!-- Create Automatic Slots -->

                <a href="  {{ route('admin.slots.create.auto') }}" class="block bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">
                    Create Automatic Slots
                </a>

                <!-- Create Slots Manually -->
                {{-- {{ route('admin.slots.create.manual') }} --}}
                <a href="" class="block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                    Create Slots Manually
                </a>

                <!-- View or Manage Slots -->
                <a href="{{ route('admin.slots.index') }}" class="block bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                    View/Manage Slots
                </a>
            </div>

        </div>
    </div>

</body>

</html>
