<x-layout title="Edit Hiking Trail">
    @include('partials.navigation')

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Edit Hiking Trail</h2>

        <!-- Form for editing the hiking trail -->
        <form action="{{ route('trails.update', $hikingTrail->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Trail Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Trail Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $hikingTrail->name) }}" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-medium">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $hikingTrail->location) }}" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('location')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Difficulty -->
            <div class="mb-4">
                <label for="difficulty" class="block text-gray-700 font-medium">Difficulty (1 to 5)</label>
                <input type="number" id="difficulty" name="difficulty" value="{{ old('difficulty', $hikingTrail->difficulty) }}" required min="1" max="5" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('difficulty')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Trail Type -->
            <div class="mb-4">
                <label for="type_trail" class="block text-gray-700 font-medium">Type of Trail</label>
                <input type="text" id="type_trail" name="type_trail" value="{{ old('type_trail', $hikingTrail->type_trail) }}" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('type_trail')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Categories Dropdown (Multiple Selection) -->
            <div class="mb-4">
                <label for="categories" class="block text-gray-700 font-medium">Select Categories</label>
                <select id="categories" name="categories[]" multiple required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', $selectedCategories)) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('categories')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update Trail
                </button>
            </div>
        </form>
    </div>

    @include('partials.footer')
</x-layout>
