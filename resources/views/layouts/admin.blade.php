<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex" style="background-image: url('/images/resizeEV3.jpg');">
    <!-- Sidebar -->
    <aside class="w-64 text-white h-full" style="background-image: url('/images/pan3.jpg');">
        <div class="p-4 text-center font-bold text-xl">Admin Panel</div>
        <nav>
            <ul>
                <li class="p-3 hover:bg-blue-700">
                    <a href="{{ route('admin.options') }}" class="block">Dashboard</a>
                </li>
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
                    {{-- <a href="{{ route('admin.options') }}" class="block">Dashboard</a> --}}
                    <a href="{{ route('admin.slots.options') }}" class="block">Slots</a>
                </li>

                <li class="p-3 hover:bg-blue-700">
                    <a href="{{ route('profile.edit') }}" class="block">Profile</a>
                </li>

                <li class="p-3 hover:bg-blue-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 ">
        <!-- Show 'Welcome to Admin Panel' only on the Dashboard page -->
        @if(request()->routeIs('admin.options'))
            <h1 class="text-3xl text-orange-300 font-semibold mb-6">Welcome to Admin Panel</h1>
        @endif

        <div class=" p-1 rounded shadow">
            @yield('content')
        </div>
    </main>
</body>

</html>
