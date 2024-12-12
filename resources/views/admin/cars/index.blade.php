<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Models Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-6"  style="background-image: url('/images/tableBack.jpg');">
        <!-- Success Modal -->
        @if (session('success'))
            <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-green-600">Success</h3>
                        <button id="closeModal" class="text-gray-500">&times;</button>
                    </div>
                    <p class="text-gray-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Car Models Management</h2>
            <a href="{{ route('admin.cars.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-md text-sm font-medium">
                + Add New Car Model
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto" style="background-image: url('/images/tableBack.jpg');">
            <table class="table-auto w-full bg-white shadow-md rounded-lg"  style="background-image: url('/images/tableBack.jpg');">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Brand</th>
                        <th class="px-4 py-2 text-left">Model</th>
                        <th class="px-4 py-2 text-left">Price per Unit</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carModels as $car)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $car->brand }}</td>
                            <td class="px-4 py-2">{{ $car->model }}</td>
                            <td class="px-4 py-2">{{ $car->price_per_unit }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('admin.cars.edit', $car->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg shadow-md text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg shadow-md text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Close the success modal when clicking the close button
        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('successModal').style.display = 'none';
        });

        // Optionally, automatically close the modal after a few seconds
        setTimeout(() => {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }, 5000);
    </script>
</body>

</html>
