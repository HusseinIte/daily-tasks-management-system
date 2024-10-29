<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Recycle Bin') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="d-flex justify-content-end m-2">
            <form action="{{ route('tasks.emptyRecycle') }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete all tasks ?')">
                    <i class="fas fa-trash-alt"></i> Empty recycle bin
                </button>
            </form>

        </div>
        @include('tasks.partails.deleted-tasks-table')
    </div>
</x-app-layout>
