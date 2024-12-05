<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create EV Station</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <!-- Page Title -->
        <h2 class="text-3xl font-semibold mb-6 text-center">Create EV Station</h2>

        <!-- Form -->
        <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <form method="POST" action="{{ route('admin.ev-stations.store') }}">
                @csrf

                <!-- Station Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Station Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        @error('name') border-red-500 @enderror" placeholder="Enter station name">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea name="address" id="address" rows="3"
                        class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        @error('address') border-red-500 @enderror" placeholder="Enter station address">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Latitude -->
                <div class="mb-4">
                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                        class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        @error('latitude') border-red-500 @enderror" placeholder="Enter latitude">
                    @error('latitude')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Longitude -->
                <div class="mb-4">
                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                        class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        @error('longitude') border-red-500 @enderror" placeholder="Enter longitude">
                    @error('longitude')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Create Station
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
