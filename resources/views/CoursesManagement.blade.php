@extends('layout')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')

    <h1>Course Management</h1>
    <a href="{{ route('course.create')}}">create new course</a>

    <div>
        <table border="1" style="border: 1px solid black; border-collapse: collapse;">
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Course Description</th>
                <th>SKS</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->CourseID }}</td>
                    <td>{{ $course->CourseName }}</td>
                    <td>{{ $course->CourseDescription }}</td>
                    <td>{{ $course->SKS }}</td>
                    <td>
                        <a href="{{ route('course.edit', ['courseId' => $course->CourseID]) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('course.destroy', ['courseId' => $course->CourseID]) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
