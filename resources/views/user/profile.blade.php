@extends('layouts.user')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">My Profile</h2>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="border border-gray-300 rounded px-4 py-2 w-full" required>
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="border border-gray-300 rounded px-4 py-2 w-full" required>
        </div>

        <!-- Password Field -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="border border-gray-300 rounded px-4 py-2 w-full">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">
                Update Profile
            </button>
        </div>
    </form>
@endsection
