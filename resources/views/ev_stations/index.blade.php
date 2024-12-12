@extends('layouts.user')

@section('content')

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">EV Stations</h2>
        <table class="table-auto w-full bg-white shadow-md rounded-lg" style="background-image: url('/images/tableBack.jpg');>
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Address</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evStations as $station)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $station->name }}</td>
                        <td class="px-4 py-2">{{ $station->address }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('ev.slots', $station->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-400">
                                View Slots
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            {{ $evStations->links() }}
        </div>
    </div>
</body>
@endsection
