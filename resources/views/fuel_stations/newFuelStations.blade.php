<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nearby Fuel Stations</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body class="bg-gray-50">

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Nearby Fuel Stations</h2>

        <!-- Map -->
        <div id="map" class="h-96 mb-4"></div>

        <!-- Stations List -->
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Address</th>
                    <th class="px-4 py-2 text-left">Distance (km)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stations as $station)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $station->name }}</td>
                        <td class="px-4 py-2">{{ $station->address ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ number_format($station->distance, 2) }} km</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="my-2">
            {{ $stations->appends(['lat' => $userLatitude, 'lng' => $userLongitude])->links() }}
        </div>
    </div>


    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize the map centered on the user's location
        var userLatitude = @json($userLatitude);
        var userLongitude = @json($userLongitude);

        var map = L.map('map').setView([userLatitude, userLongitude], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add the user's marker
        L.marker([userLatitude, userLongitude], {
            icon: L.icon({
                iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon-red.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
            }),
        }).addTo(map).bindPopup('You are here').openPopup();

        // Add markers for each fuel station
        var stations = @json($stations->items());
        stations.forEach(function(station) {
            if (station.latitude && station.longitude) {
                L.marker([station.latitude, station.longitude])
                    .addTo(map)
                    .bindPopup(station.name + '<br>' + station.address);
            }
        });
    </script>

</body>

</html>
