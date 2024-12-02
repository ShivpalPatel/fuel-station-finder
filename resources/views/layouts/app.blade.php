<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include any shared CSS or JS files here -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>



</head>
<body>
    <header>
        <h1>Fuel Station Finder</h1>
        <!-- Add navigation if needed -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024 Fuel Station Finder</p>
    </footer>
</body>
</html>
