@extends('layouts.user') <!-- Extends the user layout -->

@section('content')

    <div class= style="background-image: url('{{ asset('image/background.jpg') }}'); background-size: cover; background-position: center; height: 100vh;"
 >
        <!-- Heading -->
        <h2 class="text-3xl font-semibold text-center mb-6">Find Nearby Stations</h2>

        <!-- Buttons Section -->
        <div class="flex justify-center space-x-6" >
            <!-- Nearby Fuel Stations Button -->
            <button id="fuel-stations-btn" class="bg-blue-500 text-white px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                Find Nearby Fuel Stations
            </button>

            <!-- Nearby EV Stations Button -->
            <button id="ev-stations-btn" class="bg-green-500 text-white px-8 py-3 rounded-lg shadow-md hover:bg-green-700 transition duration-300 transform hover:scale-105">
                Find Nearby EV Stations
            </button>
        </div>
    </div>

    <script>
        // Function to get the user's geolocation
        function getUserLocation() {
            return new Promise((resolve, reject) => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        resolve({
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        });
                    }, function() {
                        reject("Unable to retrieve location.");
                    });
                } else {
                    reject("Geolocation is not supported by this browser.");
                }
            });
        }

        // Handle the click event for the "Find Nearby Fuel Stations" button
        document.getElementById('fuel-stations-btn').addEventListener('click', function() {
            getUserLocation().then(function(location) {
                // Redirect to the "Find Nearby Fuel Stations" page with lat and lng
                window.location.href = `/nearby-fuel-stations?lat=${location.lat}&lng=${location.lng}`;
            }).catch(function(error) {
                alert(error);
            });
        });

        // Handle the click event for the "Find Nearby EV Stations" button
        document.getElementById('ev-stations-btn').addEventListener('click', function() {
            getUserLocation().then(function(location) {
                // Redirect to the "Find Nearby EV Stations" page with lat and lng
                window.location.href = `/ev-stations?lat=${location.lat}&lng=${location.lng}`;
            }).catch(function(error) {
                alert(error);
            });
        });
    </script>
@endsection









{{-- before adding panal --}}
{{--
<!DOCTYPE html>
<html lang="en">

<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Fuel Stations or EVs</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 bg-cover bg-center" style="background-image: url('{{ asset('images/test.jpg') }}');"
>

    <!-- Main Content -->
    <div class="container mx-auto p-20">
        <!-- Heading -->
        <h2 class="text-3xl font-semibold text-center mb-6">Find Nearby Stations</h2>

        <!-- Buttons Section -->
        <div class="flex justify-center space-x-6">
            <!-- Nearby Fuel Stations Button -->
            <button id="fuel-stations-btn" class="bg-blue-500 text-white px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                Find Nearby Fuel Stations
            </button>

            <!-- Nearby EV Stations Button -->
            <button id="ev-stations-btn" class="bg-green-500 text-white px-8 py-3 rounded-lg shadow-md hover:bg-green-700 transition duration-300 transform hover:scale-105">
                Find Nearby EV Stations
            </button>
        </div>
    </div>

    <script>
        // Function to get the user's geolocation
        function getUserLocation() {
            return new Promise((resolve, reject) => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        resolve({
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        });
                    }, function() {
                        reject("Unable to retrieve location.");
                    });
                } else {
                    reject("Geolocation is not supported by this browser.");
                }
            });
        }

        // Handle the click event for the "Find Nearby Fuel Stations" button
        document.getElementById('fuel-stations-btn').addEventListener('click', function() {
            getUserLocation().then(function(location) {
                // Redirect to the "Find Nearby Fuel Stations" page with lat and lng
                window.location.href = `/nearby-fuel-stations?lat=${location.lat}&lng=${location.lng}`;
            }).catch(function(error) {
                alert(error);
            });
        });

        // Handle the click event for the "Find Nearby EV Stations" button
        document.getElementById('ev-stations-btn').addEventListener('click', function() {
            getUserLocation().then(function(location) {
                // Redirect to the "Find Nearby EV Stations" page with lat and lng
                window.location.href = `/ev-stations?lat=${location.lat}&lng=${location.lng}`;
            }).catch(function(error) {
                alert(error);
            });
        });
    </script>

</body>

</html> --}}
