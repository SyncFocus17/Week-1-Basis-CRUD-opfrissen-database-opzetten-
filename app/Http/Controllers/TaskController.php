<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index(): View
    {
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }

    /**
     * Toggle the completion status of a task.
     */
    public function toggle(Task $task): RedirectResponse
    {
        $task->update(['is_done' => !$task->is_done]);

        $status = $task->is_done ? 'completed' : 'marked as pending';
        
        return redirect()->route('tasks.index')
            ->with('success', "Task {$status}!");
    }
}