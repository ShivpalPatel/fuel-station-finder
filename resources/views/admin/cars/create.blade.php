<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Car Model</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6 text-center">Create Car Model</h2>

        <!-- Form Section -->
        <form action="{{ route('admin.cars.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <!-- Brand Field -->
            <div class="mb-4">
                <label for="brand" class="block text-sm font-semibold text-gray-700">Car Brand</label>
                <input type="text" name="brand" id="brand" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200" placeholder="Enter Car Brand" required>
                @error('brand')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Model Field -->
            <div class="mb-4">
                <label for="model" class="block text-sm font-semibold text-gray-700">Car Model</label>
                <input type="text" name="model" id="model" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200" placeholder="Enter Car Model" required>
                @error('model')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price per Unit Field -->
            <div class="mb-6">
                <label for="price_per_unit" class="block text-sm font-semibold text-gray-700">Price per Unit</label>
                <input type="number" step="0.01" name="price_per_unit" id="price_per_unit" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200" placeholder="Enter Price per Unit" required>
                @error('price_per_unit')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between">
                <a href="{{ route('admin.cars.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                    Create Car Model
                </button>
            </div>
        </form>
    </div>
</body>

</html>
