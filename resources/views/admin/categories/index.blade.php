<x-app-layout>
    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Manage Categories</h1>
                <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Category</a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow rounded p-4">
                @forelse($categories as $category)
                    <div class="border-b py-3 flex justify-between items-center">
                        <div>{{ $category->name }}</div>

                        <div class="flex gap-3">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-yellow-600">Edit</a>

                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600" onclick="return confirm('Delete this category?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>No categories found.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>