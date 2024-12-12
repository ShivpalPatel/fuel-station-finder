<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <script>
        @if(auth()->user()->hasRole('SuperAdmin'))
            window.location.href = "{{ route('admin.options') }}";  // Redirect to admin panel
        @elseif(auth()->user()->hasRole('user'))
            window.location.href = "{{ route('options') }}";  // Redirect to user panel
        @endif
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>








{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <!-- Role-based redirect -->
                    @if(auth()->user()->hasRole('SuperAdmin'))
                        <div class="mt-6 p-4 bg-green-100 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold">Admin Dashboard</h3>
                            <p class="mt-2">Welcome, SuperAdmin! You have full access to manage the application.</p>
                            <a href="{{ route('admin.options') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                                Go to Admin Panel
                            </a>
                        </div>
                    @elseif(auth()->user()->hasRole('user'))
                        <div class="mt-6 p-4 bg-yellow-100 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold">User Dashboard</h3>
                            <p class="mt-2">Welcome, User! You can view and manage your bookings.</p>
                            <a href="{{ route('options') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                                Go to User Panel
                            </a>
                        </div>
                    @else
                        <div class="mt-6 p-4 bg-gray-100 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold">Welcome!</h3>
                            <p class="mt-2">Please complete your registration or contact the administrator.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>





{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

            </div>
        </div>
    </div>
</div>

</x-app-layout> --}}


 --}}
