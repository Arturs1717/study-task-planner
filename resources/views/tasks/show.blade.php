<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <h1 class="text-2xl font-bold mb-4">{{ $task->title }}</h1>

                <p class="mb-2"><strong>Description:</strong> {{ $task->description ?: '-' }}</p>
                <p class="mb-2"><strong>Subject:</strong> {{ $task->subject->name ?? '-' }}</p>
                <p class="mb-2"><strong>Category:</strong> {{ $task->category->name ?? '-' }}</p>
                <p class="mb-2"><strong>Deadline:</strong> {{ $task->deadline ?: '-' }}</p>
                <p class="mb-2"><strong>Status:</strong> {{ $task->status }}</p>

                <div class="mt-4">
                    <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                    <a href="{{ route('tasks.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded ml-2">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>