<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subject;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with(['subject', 'category'])
            ->where('user_id', auth()->id());

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $tasks = $query->latest()->get();
        $subjects = Subject::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('tasks.index', compact('tasks', 'subjects', 'categories'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('tasks.create', compact('subjects', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'subject_id' => $request->subject_id,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->load(['subject', 'category']);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $subjects = Subject::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('tasks.edit', compact('task', 'subjects', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task->update($request->only([
            'title',
            'description',
            'deadline',
            'status',
            'subject_id',
            'category_id',
        ]));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}