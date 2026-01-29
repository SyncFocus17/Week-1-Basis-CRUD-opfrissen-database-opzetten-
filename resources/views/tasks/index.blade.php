@extends('layouts.app')

@section('title', 'All Tasks - Todo App Mini')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-list me-2"></i>My Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Task
    </a>
</div>

@if($tasks->isEmpty())
    <div class="text-center py-5">
        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
        <h3 class="text-muted">No tasks yet!</h3>
        <p class="text-muted">Create your first task to get started.</p>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create First Task
        </a>
    </div>
@else
    <div class="row">
        @foreach($tasks as $task)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 {{ $task->is_done ? 'border-success' : 'border-warning' }}">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 {{ $task->is_done ? 'text-decoration-line-through text-muted' : '' }}">
                            {{ $task->title }}
                        </h6>
                        <span class="badge {{ $task->is_done ? 'bg-success' : 'bg-warning' }}">
                            {{ $task->is_done ? 'Done' : 'Pending' }}
                        </span>
                    </div>
                    <div class="card-body">
                        @if($task->description)
                            <p class="card-text {{ $task->is_done ? 'text-muted' : '' }}">
                                {{ Str::limit($task->description, 100) }}
                            </p>
                        @else
                            <p class="card-text text-muted fst-italic">No description</p>
                        @endif
                        <small class="text-muted">
                            Created: {{ $task->created_at->format('M j, Y') }}
                        </small>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-{{ $task->is_done ? 'warning' : 'success' }} btn-sm">
                                    <i class="fas fa-{{ $task->is_done ? 'undo' : 'check' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Tasks</h5>
                        <h2 class="text-primary">{{ $tasks->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">Completed</h5>
                        <h2 class="text-success">{{ $tasks->where('is_done', true)->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection