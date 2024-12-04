@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Task</h2>

    <!-- Form to edit the task -->
    <form action="{{ route('task.update', ['CourseID' => $task->course_id, 'SessionID' => $task->session_id, 'TaskID' => $task->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="taskName">Task Name</label>
            <input type="text" class="form-control" id="taskName" name="taskName" value="{{ old('taskName', $task->taskName) }}" required>
        </div>

        <div class="form-group">
            <label for="taskDescription">Description</label>
            <textarea class="form-control" id="taskDescription" name="taskDescription" rows="4" required>{{ old('taskDescription', $task->taskDesc) }}</textarea>
        </div>

        <div class="form-group">
            <label for="taskDueDate">Due Date</label>
            <input type="date" class="form-control" id="taskDueDate" name="taskDueDate" value="{{ old('taskDueDate', $task->taskDueDate->toDateString()) }}" required>
        </div>

        <div class="form-group">
            <label for="taskType">Task Type</label>
            <select class="form-control" id="taskType" name="taskType">
                <option value="Assignment" {{ $task->taskType == 'Assignment' ? 'selected' : '' }}>Assignment</option>
                <option value="Quiz" {{ $task->taskType == 'Quiz' ? 'selected' : '' }}>Quiz</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>

    <a href="{{ route('session.show', ['CourseID' => $task->course_id, 'SessionID' => $task->session_id]) }}" class="btn btn-secondary mt-3">Back to Session</a>
</div>
@endsection
