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
                <a href="{{ route('admin.slots.create.auto') }}"
                    class="block bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">
                    Create Automatic Slots
                </a>

                {{-- {{ route('admin.slots.create.single') }} --}}
                <!-- Create Slots Manually -->
                <a href=""
                    class="block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                    Create Single Slot
                </a>

                <!-- View or Manage Slots -->
                <a href="{{ route('admin.slots.index') }}"
                    class="block bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                    View/Manage Slots
                </a>

                <!-- Delete Old Available Slots -->
                <button onclick="showConfirmationModal()"
                    class="block bg-red-600 text-white px-14 py-3 rounded-lg hover:bg-pink-400 transition duration-300">
                    Delete Old Available Slots
                </button>

            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm text-center">
            <h3 class="text-lg font-semibold text-gray-700">Delete Old Available Slots</h3>
            <p class="text-gray-500 my-4">
                Are you sure you want to delete all old available slots? This action cannot be undone. This will delete all availble slots that are of old date as of now.
            </p>
            <div class="flex justify-around mt-6">
                <button onclick="hideConfirmationModal()"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Cancel
                </button>
                <form id="delete-slots-form" action="{{ route('admin.slots.delete-old') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('confirmation-modal');

        function showConfirmationModal() {
            modal.classList.remove('hidden');
        }

        function hideConfirmationModal() {
            modal.classList.add('hidden');
        }
    </script>

</body>

</html>

{{-- before creating deelte popup --}}
{{-- <!DOCTYPE html>
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
                <a href="  {{ route('admin.slots.create.auto') }}"
                    class="block bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">
                    Create Automatic Slots
                </a>

                <!-- Create Slots Manually -->

                <a href=" {{ route('admin.slots.create.single') }}"
                    class="block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                    Create Single Slot
                </a>

                <!-- View or Manage Slots -->
                <a href="{{ route('admin.slots.index') }}"
                    class="block bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                    View/Manage Slots
                </a>

                <!-- Delete Old Available Slots -->
                <a href="{{ route('admin.slots.delete-old') }}"
                    class="block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-pink-400 transition duration-300">
                    Delete Old Available Slots
                </a>
            </div>

        </div>
    </div>

</body>

</html> --}}
