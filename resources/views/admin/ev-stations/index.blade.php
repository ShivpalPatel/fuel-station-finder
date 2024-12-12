@extends('layouts.admin')

@section('content')
<body class="bg-gray-50" >
    <div class="container mx-auto p-6" style="background-image: url('/images/tableBack.jpg');">
        <!-- Success Message Modal -->
        @if (session('success'))
            <div id="successModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center" >
                    <h3 class="text-lg font-semibold text-green-600 mb-4">Success!</h3>
                    <p class="text-gray-700 mb-4">{{ session('success') }}</p>
                    <button id="closeModal"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        OK
                    </button>
                </div>
            </div>
        @endif

        <!-- Page Title -->
        <div class="flex justify-between items-center mb-6 ">
            <h2 class="text-3xl font-semibold text-gray-800">EV Stations Management</h2>
            <!-- Create Button -->
            <a href="{{ route('admin.ev-stations.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-md text-sm font-medium">
                + Add New EV Station
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto" style="background-image: url('/images/tableBack.jpg');">
            <table class="table-auto w-full bg-white shadow-md rounded-lg" style="background-image: url('/images/tableBack.jpg');">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Address</th>
                        <th class="px-4 py-2 text-left">Latitude</th>
                        <th class="px-4 py-2 text-left">Longitude</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($evStations as $station)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $station->name }}</td>
                            <td class="px-4 py-2">{{ $station->address }}</td>
                            <td class="px-4 py-2">{{ $station->latitude }}</td>
                            <td class="px-4 py-2">{{ $station->longitude }}</td>
                            <td class="px-4 py-2 text-center">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.ev-stations.edit', $station->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg shadow-md text-sm">
                                    Edit
                                </a>
                                <!-- Delete Form -->
                                <form action="{{ route('admin.ev-stations.destroy', $station->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg shadow-md text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-4 py-2 text-gray-500">
                                No EV Stations found. <a href="{{ route('admin.ev-stations.create') }}" class="text-blue-500 underline">Add one now</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class=" mt-4 mr-3">
                {{ $evStations->links() }}
            </div>
        </div>
    </div>

    <!-- Close Modal Script -->
    <script>
        const successModal = document.getElementById('successModal');
        const closeModal = document.getElementById('closeModal');

        if (closeModal) {
            closeModal.addEventListener('click', () => {
                successModal.style.display = 'none';
            });
        }
    </script>
</body>

@endsection
