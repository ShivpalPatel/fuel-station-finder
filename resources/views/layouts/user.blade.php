<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Main container to hold the sidebar and main content -->
    <div class="min-h-screen flex" >

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-600 text-white p-6" style="background-image: url('/images/pan3.jpg');">
            <div class="text-center font-bold text-xl mb-8">User Panel</div>
            <nav>
                <ul class="space-y-4">

                    <li class="p-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        <a href="{{ route('dashboard') }}" class="block">Dashboard</a>
                    </li>

                    <li class="p-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        <a href="{{ route('profile.edit') }}" class="block">Profile</a>
                    </li>

                    {{-- <li class="p-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        <a href="{{ route('findNearbyFuel') }}" class="block">Find Nearby Fuel Stations</a>
                    </li> --}}

                    {{-- for sending loacation of user we use this approach --}}
                    <li class="p-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        <a id="find-fuel-link" href="#" class="block">Find Nearby Fuel Stations</a>
                    </li>


                    <li class="p-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        <a href="{{ route('ev.stations') }}" class="block">Find Nearby EV Stations</a>
                    </li>

                    <li class="p-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        <a href="{{ route('user.bookings') }}" class="block">My Bookings</a>
                    </li>

                    <li class="p-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <h1 class="text-4xl font-semibold mb-6 text-gray-800">Welcome to Your User Dashboard</h1>

            <div class="bg-white p-8 rounded-lg shadow-md">
                @yield('content') <!-- This will inject content from child views -->
            </div>
        </main>

    </div>

</body>
<script>
    // Function to get the user's geolocation
function getUserLocation() {
    return new Promise((resolve, reject) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                resolve({
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                });
            }, function () {
                reject("Unable to retrieve location.");
            });
        } else {
            reject("Geolocation is not supported by this browser.");
        }
    });
}

// Update the href attribute of the "Find Nearby Fuel Stations" link
document.addEventListener('DOMContentLoaded', function () {
    const link = document.getElementById('find-fuel-link');

    // Get user location
    getUserLocation()
        .then(function (location) {
            // Set the dynamic href with lat and lng
            link.href = `/nearby-fuel-stations?lat=${location.lat}&lng=${location.lng}`;
        })
        .catch(function (error) {
            alert(error);
        });
});
</script>

</html>





{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-600 text-white h-full p-4">
            <div class="text-center font-bold text-xl mb-6">User Panel</div>
            <nav>
                <ul>
                    <li class="p-3 hover:bg-blue-700">
                        <a href="{{ route('profile.edit') }}" class="block">Profile</a>
                    </li>
                    <li class="p-3 hover:bg-blue-700">
                        <a href="{{ route('user.bookings') }}" class="block">My Bookings</a>
                    </li>
                    {{-- <li class="p-3 hover:bg-blue-700">
                        <a href="{{ route('user.settings') }}" class="block">Settings</a>
                    </li> --}}
                    {{-- <li class="p-3 hover:bg-blue-700">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-semibold mb-6">Welcome to Your User Dashboard</h1>
            <div class="bg-white p-6 rounded-lg shadow-md">
                @yield('content') <!-- Content will be injected here -->
            </div>
        </main>
    </div>
</body>

</html> --}}
