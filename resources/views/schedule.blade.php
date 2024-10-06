<!DOCTYPE html>
<html>
<head>
    <title>Course Schedules - {{ $semester }}</title>
</head>
<body>
    <h1>Course Schedules for {{ $semester }}</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Day</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule['courseCode'] }}</td>
                    <td>{{ $schedule['title'] }}</td>
                    <td>{{ $schedule['day'] }}</td>
                    <td>{{ $schedule['time'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
