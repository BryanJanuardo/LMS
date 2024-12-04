@extends('layout')

@section('title', 'Course Management')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Course Management</h1>

        <!-- Create New Course Button -->
        <a href="{{ route('course.create') }}" class="btn btn-primary mb-4">
            Create New Course
        </a>

        <!-- Course Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>    
                        <th>Course Name</th>
                        <th>Course Description</th>
                        <th>SKS</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->courseLearning->course->CourseName }}</td>
                            <td>{{ $course->courseLearning->course->CourseDescription }}</td>
                            <td>{{ $course->courseLearning->course->SKS }}</td>
                            <td>
                                <a href="{{ route('course.edit', ['courseId' => $course->courseLearning->id]) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('course.destroy', ['courseId' => $course->courseLearning->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    @csrf
                                    @method('delete')
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
