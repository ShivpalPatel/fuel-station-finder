@extends('layouts.admin')

@section('content')

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6 text-center text-gray-800">Edit EV Station</h2>

        <!-- Form Section -->
        <form action="{{ route('admin.ev-stations.update', $evStation->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700">Station Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $evStation->name) }}"
                    class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200"
                    placeholder="Enter EV Station Name" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address Field -->
            <div class="mb-4">
                <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                <textarea name="address" id="address" rows="4"
                    class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200"
                    placeholder="Enter EV Station Address" required>{{ old('address', $evStation->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Latitude Field -->
            <div class="mb-4">
                <label for="latitude" class="block text-sm font-semibold text-gray-700">Latitude</label>
                <input type="number" step="any" name="latitude" id="latitude" value="{{ old('latitude', $evStation->latitude) }}"
                    class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200"
                    placeholder="Enter Latitude" required>
                @error('latitude')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Longitude Field -->
            <div class="mb-6">
                <label for="longitude" class="block text-sm font-semibold text-gray-700">Longitude</label>
                <input type="number" step="any" name="longitude" id="longitude" value="{{ old('longitude', $evStation->longitude) }}"
                    class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200"
                    placeholder="Enter Longitude" required>
                @error('longitude')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between">
                <a href="{{ route('admin.ev-stations.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                    Update Station
                </button>
            </div>
        </form>
    </div>
</body>

@endsection
