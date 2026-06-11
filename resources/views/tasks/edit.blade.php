<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Edit Task</h1>

            <form action="{{ route('tasks.update', $task) }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Title</label>
                    <input type="text" name="title" value="{{ $task->title }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Description</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2">{{ $task->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Deadline</label>
                    <input type="date" name="deadline" value="{{ $task->deadline }}" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Subject</label>
                    <select name="subject_id" class="w-full border rounded px-3 py-2" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $task->subject_id == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Category</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>