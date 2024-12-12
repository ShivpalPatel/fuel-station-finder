<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-center h-screen" style="background-image: url('https://images3.alphacoders.com/973/thumb-1920-973751.jpg');">
    <div class="flex items-center justify-center min-h-screen bg-gray-900 bg-opacity-20">
        <div class=" rounded-lg shadow-lg p-8 w-full max-w-md">
            <h1 class="text-2xl font-bold text-center mb-6">Register</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-white">Name</label>
                    <input id="name" class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-white">Email</label>
                    <input id="email" class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-white">Password</label>
                    <input id="password" class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm Password</label>
                    <input id="password_confirmation" class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="password" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">Already registered?</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
