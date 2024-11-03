<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user() && auth()->user()->role == 1)
                        <x-nav-link href="{{route('trails.show')}}" :active="request()->is('trails.show')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Hiking Trails</x-nav-link>
                        <x-nav-link href="{{route('categories.show')}}" :active="request()->is('categories.show')" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Categories</x-nav-link>
                    @elseif(auth()->user() && auth()->user()->role == 0)
                        <p>Welcome to your dashboard!</p>
                    @endif

                    @php
                        // Count the number of hiking trails created by the admin
                        $trailCount = App\Models\HikingTrail::where('created_by', auth()->id())->count();
                    @endphp

                    <a href="{{ route('users.show') }}"
                       class="rounded-md px-3 py-2 text-sm font-medium
                       {{ $trailCount < 5 ? 'text-gray-400 cursor-not-allowed' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}
                       {{ $trailCount < 5 ? 'opacity-50' : 'opacity-100' }}"
                       @if($trailCount < 5) onclick="event.preventDefault();" title="You need to have atleast created 5 trails as an Admin to observe the users."
                       data-tooltip="You need to have atleast created 5 trails as an Admin to observe the users."
                       class="relative group"
                        @endif>
                        Users
                    </a>

                    @if($trailCount < 5)
                        <span class="absolute left-1/2 transform -translate-x-1/2 -translate-y-8 bg-gray-700 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            You need to have created at least 5 hiking trails as an admin to observe the users.
                        </span>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
