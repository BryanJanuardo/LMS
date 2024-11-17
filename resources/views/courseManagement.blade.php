@extends('layout')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')

    <h1>Course Management</h1>
    <a href="courseCreate">create new course</a>

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
            @foreach($courses as $item)
                <tr>
                    <td>{{ $item->CourseID }}</td>
                    <td>{{ $item->CourseName }}</td>
                    <td>{{ $item->CourseDescription }}</td>
                    <td>{{ $item->SKS }}</td>
                    <td>
                        <a href="{{ route('courseManagement.edit', ['course' => $item->CourseID]) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('courseManagement.destroy', ['course' => $item->CourseID]) }}" method="post">
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
