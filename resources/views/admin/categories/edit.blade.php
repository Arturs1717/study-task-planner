<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Edit Category</h1>

            <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>