<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4 text-gray-900">Add Task</h1>

            <form action="{{ route('tasks.store') }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">Title</label>
                    <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Description</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Deadline</label>
                    <input type="date" name="deadline" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="To Do">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Subject</label>
                    <select name="subject_id" class="w-full border rounded px-3 py-2" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block mb-1">Category</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded shadow">
                        Save Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>