@extends('layout')

@section('content')
<div class="container">
    <h2>Add {{$TaskType}}</h2>

    <!-- Form to edit the task -->
    <form action="{{ route('task.store', ['CourseID' => $CourseID, 'SessionID' => $SessionID, 'TaskType' => $TaskType, 'PreviousURL' => URL::previous()]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="taskName">Task Name</label>
            <input type="text" class="form-control" id="TaskName" name="TaskName" placeholder="Enter task name" required>
        </div>

        <div class="form-group">
            <label for="taskDescription">Description</label>
            <textarea class="form-control" id="TaskDesc" name="TaskDesc" rows="4" placeholder="Enter task description" required></textarea>
        </div>

        <div class="form-group">
            <label for="taskDueDate">Due Date</label>
            <input type="date" class="form-control" id="TaskDueDate" name="TaskDueDate" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>

</div>
@endsection
