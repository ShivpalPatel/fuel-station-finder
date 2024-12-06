<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-600 text-white h-full">
        <div class="p-4 text-center font-bold text-xl">Admin Panel</div>
        <nav>
            <ul>
                <li class="p-3 hover:bg-blue-700">
                    <a href="{{ route('admin.ev-stations.index') }}" class="block">EV Stations</a>
                </li>
                <li class="p-3 hover:bg-blue-700">
                    <a href="{{ route('admin.cars.index') }}" class="block">Cars Management</a>
                </li>
                <li class="p-3 hover:bg-blue-700">
                    <a href="{{ route('admin.users.index') }}" class="block">Users</a>
                </li>
                <li class="p-3 hover:bg-blue-700">
                    <a href="{{ route('admin.bookings.index') }}" class="block">Bookings</a>
                </li>
                <li class="p-3 hover:bg-blue-700">
                    <a href="{{ route('admin.slots.options') }}" class="block">Slots</a>
                </li>

                <li class="p-3 hover:bg-blue-700">
                    <a href="{{ route('admin.options') }}" class="block">Dashboard</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-semibold mb-6">Welcome to Admin Panel</h1>
        <div class="bg-white p-6 rounded shadow">
            @yield('content')
        </div>
    </main>
</body>

</html>
