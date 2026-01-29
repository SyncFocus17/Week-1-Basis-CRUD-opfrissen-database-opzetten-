@extends('layouts.app')

@section('title', 'Edit Task - Todo App Mini')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Task</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Task Title *</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $task->title) }}" 
                               placeholder="Enter task title"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Enter task description (optional)">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" disabled {{ $task->is_done ? 'checked' : '' }}>
                            <label class="form-check-label text-muted">
                                Task Status: {{ $task->is_done ? 'Completed' : 'Pending' }}
                            </label>
                        </div>
                        <small class="text-muted">Use the toggle button on the tasks list to change status.</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Tasks
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection