<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="d-flex justify-content-end">
            <a href="{{ route('tasks.create') }}" class="btn btn-success m-2">
                <i class="fas fa-plus"></i> Add Task
            </a>
            <a href="{{ route('tasks.recycle') }}" class="btn btn-primary m-2">
                <i class="fas fa-trash-alt"></i> Recycle Bin
            </a>
        </div>
        @include('tasks.partails.tasks-table')
    </div>
</x-app-layout>
