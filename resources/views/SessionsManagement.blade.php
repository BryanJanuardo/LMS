@extends('layout')

@section('title', 'Session Management')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Session Management</h1>

        <a href="{{ route('session.create', ['CourseID' => $courseID]) }}" class="btn btn-primary mb-4">
            Create New Session
        </a>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Session Name</th>
                        <th>Session Description</th>
                        <th>Session Start</th>
                        <th>Session End</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessionLearnings as $sessionLearning)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sessionLearning->session->SessionName }}</td>
                            <td>{{ $sessionLearning->session->SessionDescription }}</td>
                            <td>{{ $sessionLearning->session->SessionStart }}</td>
                            <td>{{ $sessionLearning->session->SessionEnd }}</td>
                            <td>
                                <a href="{{ route('session.edit', ['CourseID' => $courseID, 'SessionID' => $sessionLearning->id]) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('session.delete', ['CourseID' => $courseID, 'SessionID' => $sessionLearning->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
