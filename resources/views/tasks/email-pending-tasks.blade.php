<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>

<body>
    <div>
        <b>Hello {{ $user->name }}</b>
        This is daily pending tasks
    </div>

    <table class="table table-striped table-hover m-3">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Status</th>
                <th>Description</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example task row -->
            @foreach ($pendingTasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->due_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
