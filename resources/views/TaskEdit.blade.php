@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Task</h2>

    <!-- Form to edit the task -->
    <form action="{{ route('task.update', ['CourseID' => $CourseID, 'SessionID' => $SessionID, 'TaskID' => $task->TaskID, 'PreviousURL' => URL::previous()]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="TaskName">Task Name</label>
            <input type="text" class="form-control" id="TaskName" name="TaskName" value="{{ old('TaskName', $task->TaskName) }}" required>
        </div>

        <div class="form-group">
            <label for="TaskDesc">Description</label>
            <textarea class="form-control" id="TaskDesc" name="TaskDesc" rows="4" required>{{ old('TaskDesc', $task->TaskDesc)}}</textarea>
        </div>

        <div class="form-group">
            <label for="TaskDueDate">Due Date</label>
            <input type="date" class="form-control" id="TaskDueDate" name="TaskDueDate" value="{{ old('TaskDueDate', $task->TaskDueDate) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>

</div>
@endsection
