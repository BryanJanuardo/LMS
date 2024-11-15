<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
</head>
<body>
    <h1>Your active tasks</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Type</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            @if (count($tasks) > 0)
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task['TaskName'] }}</td>
                    <td>{{ $task['TaskDesc'] }}</td>
                    <td>{{ $task['TaskType'] }}</td>
                    <td>{{ $task['TaskDueDate'] }}</td>
                </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4">No tasks found.</td>
            </tr>
            @endif

        </tbody>
    </table>
</body>
</html>
