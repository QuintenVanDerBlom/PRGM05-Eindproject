<x-layout title="User Management">
    @include('partials.navigation')

    <section class="m-4">
        <h2 class="text-2xl font-semibold mb-4">User Management</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 shadow-sm">
                <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Email</th>
                    <th class="px-4 py-2 border-b">Role</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $user->email }}</td>
                        <td class="px-4 py-2 border-b">
                            <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>User</option>
                                </select>
                                <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">Update</button>
                            </form>
                        </td>
                        <td class="px-4 py-2 border-b">
                            <button class="text-gray-600 hover:text-blue-500">View</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    @include('partials.footer')
</x-layout>
