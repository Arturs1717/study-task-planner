<x-app-layout>
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Manage Users</h1>

            <div class="bg-white shadow rounded p-4">
                @forelse($users as $user)
                    <div class="border-b py-3 flex justify-between items-center">
                        <div>
                            <div class="font-semibold">{{ $user->name }}</div>
                            <div class="text-sm text-gray-600">{{ $user->email }}</div>
                            <div class="text-sm text-gray-600">Role: {{ $user->role }}</div>
                            <div class="text-sm text-gray-600">Blocked: {{ $user->is_blocked ? 'Yes' : 'No' }}</div>
                        </div>

                        <div>
                            @if($user->is_blocked)
                                <form action="{{ route('admin.users.unblock', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-green-600 text-white px-4 py-2 rounded">Unblock</button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.block', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-red-600 text-white px-4 py-2 rounded">Block</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>No users found.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>