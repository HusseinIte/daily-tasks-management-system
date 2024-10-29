<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Tasks') }}
        </h2>
    </x-slot>
    <div class="container m-4">
        <!-- Add Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST">
            <!-- Include CSRF token for security if using Laravel -->
            @csrf

            <!-- Task Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Task Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Due Date -->
            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}">
                @error('due_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="d-flex justify-center">
                <button type="submit" class="btn btn-success">Add Task</button>
            </div>
        </form>
    </div>

</x-app-layout>
