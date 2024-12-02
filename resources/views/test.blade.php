@extends('layout')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush
@section('content')
@foreach($sessions as $session)
    <div class="session-card">
        <h2>{{ $session->SessionName }}</h2>
        <p>{{ $session->SessionDescription }}</p>

        <h3>Tasks:</h3>
        <ul>
            @foreach($session->tasks as $task)
                <li>
                    <strong>{{ $task->TaskName }}</strong> - {{ $task->TaskDesc }} (Due: {{ $task->TaskDueDate }})
                </li>
            @endforeach
        </ul>
    </div>
@endforeach
@endsection
