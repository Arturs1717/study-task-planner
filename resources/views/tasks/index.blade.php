<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold">My Tasks</h1>
                <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Add Task
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('tasks.index') }}" class="bg-white p-4 rounded shadow mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title"
                        class="border rounded px-3 py-2">

                    <select name="status" class="border rounded px-3 py-2">
                        <option value="">All statuses</option>
                        <option value="To Do" {{ request('status') == 'To Do' ? 'selected' : '' }}>To Do</option>
                        <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>

                    <select name="subject_id" class="border rounded px-3 py-2">
                        <option value="">All subjects</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="category_id" class="border rounded px-3 py-2">
                        <option value="">All categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <button class="bg-gray-800 text-white px-4 py-2 rounded">Filter</button>
                </div>
            </form>

            <div class="bg-white shadow rounded p-4">
                @forelse($tasks as $task)
                    <div class="border-b py-4 flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $task->title }}</h2>
                            <p class="text-sm text-gray-600">Subject: {{ $task->subject->name ?? '-' }}</p>
                            <p class="text-sm text-gray-600">Category: {{ $task->category->name ?? '-' }}</p>
                            <p class="text-sm text-gray-600">Deadline: {{ $task->deadline ?? '-' }}</p>
                            <p class="text-sm text-gray-600">Status: {{ $task->status }}</p>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-600">View</a>
                            <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-600">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600" onclick="return confirm('Delete this task?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>No tasks found.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>