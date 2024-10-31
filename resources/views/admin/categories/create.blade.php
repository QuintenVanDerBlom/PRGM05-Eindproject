<x-layout title="Create Hiking Trail">
    @include('partials.navigation')

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Create a New Category</h2>

        <!-- Form for creating a new trail -->
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <!-- Trail Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Trail Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create Trail
                </button>
            </div>
        </form>
    </div>

    @include('partials.footer')
</x-layout>
