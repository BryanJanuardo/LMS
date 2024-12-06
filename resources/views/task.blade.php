@extends('layout')

@section('title', 'tasks')

@push('styles')
    <link href="{{ asset('css/tasks.css') }}" rel="stylesheet">
@endpush
@section('content')
    <h1 style="margin-bottom: 16px;">My tasks</h1>
    @include('components.divider')
    <div id="taskList" class="task-container row">
        @foreach ($tasks as $task)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task['TaskName'] }}</h5>
                        <p class="card-text">{{ $task['TaskDesc'] }}</p>
                        <div class="task-details">
                            <div class="task-detail">
                                <i class="bi bi-calendar-event-fill"></i>
                                <span class="task-code">{{ $task['TaskDueDate'] }}</span>
                            </div>
                            <div class="task-detail">
                                <i class="bi bi-clipboard-fill"></i>
                                <span class="task-credits">{{ $task['TaskType'] }}</span>
                            </div>
                        </div>

                        {{-- <a href="{{ route('task.detail', $task->taskID) }}" class="btn btn-primary">View Details</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
