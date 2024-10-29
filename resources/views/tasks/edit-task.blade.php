<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tasks') }}
        </h2>
    </x-slot>
    <div class="container m-4">
        <!-- Edit Task Form -->
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            <!-- Include CSRF token for security if using Laravel -->
            @csrf
            @method('PUT')

            <!-- Task Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $task->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Task Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Pending" {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>Pending
                    </option>
                    <option value="Completed" {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>
                        Completed</option>
                </select>
            </div>

            <!-- Task Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Due Date -->
            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date"
                    value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                @error('due_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>



            <div class="d-flex justify-center">
                <button type="submit" class="btn btn-success">Save changes</button>
            </div>
        </form>
    </div>
</x-app-layout>
