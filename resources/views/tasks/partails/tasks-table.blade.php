<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Status</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Example task row -->
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>
                    <!-- Dropdown to edit task status -->
                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST"
                        id="status-form-{{ $task->id }}">
                        @csrf
                        @method('PUT')
                        <select class="form-select form-select-sm" name="status"
                            onchange="document.getElementById('status-form-{{ $task->id }}').submit();">
                            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                    </form>
                </td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->due_date }}</td>
                <td>
                    <!-- Edit Task Button to trigger the modal -->
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this task?')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

        <!-- Repeat task rows as needed -->
    </tbody>
</table>
