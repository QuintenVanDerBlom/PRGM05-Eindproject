<x-layout title="Solice">
    @include('partials.navigation')
    <section class="m-2">
        <form action="{{ route('trails.show') }}" method="GET" class="flex gap-2">
            <!-- Search Input -->
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search trails..."
                class="text-sm px-4 py-2 border rounded-lg focus:outline-none"/>

            <!-- Dropdown -->
            <select
                name="category"
                class="text-sm px-4 py-2 border rounded-lg focus:outline-none"
                onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- Search Button -->
            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Search
            </button>

            <!-- Create Button -->
            <a href="{{ route('trails.create') }}" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Create New Entry</a>
        </form>
    </section>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Location</th>
                <th scope="col" class="px-6 py-3">Trail Type</th>
                <th scope="col" class="px-6 py-3">Difficulty</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
                <th scope="col" class="px-6 py-3"><span class="sr-only">Delete</span></th>
            </tr>
            </thead>
            <tbody>
            @foreach($trails as $trail)
                @php
                    $isInactive = $trail->categories->contains(fn($category) => !$category->is_active);
                    $isCreator = auth()->id() === $trail->created_by;
                @endphp
                <tr class="border-b hover:bg-gray-50 {{ $isInactive ? 'bg-gray-200 text-gray-500' : 'bg-white' }}">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $trail->location }}</th>
                    <td class="px-6 py-4">{{ $trail->type_trail }}</td>
                    <td class="px-6 py-4">{{ $trail->difficulty }}</td>
                    <td class="px-6 py-4">{{ $trail->name }}</td>
                    <td class="px-6 py-4">
                        @foreach($trail->categories as $category)
                            <span class="rounded px-2 py-1 {{ $category->is_active ? 'bg-blue-500 text-white' : 'bg-gray-400 text-gray-700' }}">
                                    {{ $category->name }}
                                </span>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($isCreator)
                            <a href="{{ route('trails.edit', $trail->id) }}" class="font-medium {{ $isInactive ? 'text-gray-400 cursor-not-allowed' : 'text-blue-600 hover:underline' }}" {{ $isInactive ? 'onclick="return false;"' : '' }}>
                                Edit
                            </a>
                        @else
                            <span class="text-gray-400">Edit</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($isCreator)
                            <form action="{{ route('trails.destroy', $trail->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium {{ $isInactive ? 'text-gray-400 cursor-not-allowed' : 'text-red-600 hover:underline' }}" {{ $isInactive ? 'disabled' : '' }}>
                                    Delete
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400">Delete</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('partials.footer')
</x-layout>
