<x-layout title="Solice">
    @include('partials.navigation')

    <section class="m-2">
        <form action="{{ route('categories.show') }}" method="GET" class="flex gap-2 mb-4">
            <!-- Search Input -->
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search categories..."
                class="text-sm px-4 py-2 border rounded-lg focus:outline-none"
            />

            <!-- Search Button -->
            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Search
            </button>

            <!-- Create Button -->
            <a href="{{ route('categories.create') }}" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Create New Entry
            </a>
        </form>
    </section>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
                <th scope="col" class="px-6 py-3"><span class="sr-only">Delete</span></th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('categories.edit', $category->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <!-- Delete form -->
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('partials.footer')
</x-layout>
