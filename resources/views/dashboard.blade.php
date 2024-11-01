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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
