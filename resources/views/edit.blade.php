@extends('layout')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')

    <h1>Edit a course</h1>
    <form method="post" action=" {{ route('courseManagement.update', ['course' => $course]) }}">
        @csrf
        @method('PUT ')
        <div>
            <label for="">Name</label>
            <input type="name" name="CourseName" placeholder="name" value="{{ $course->CourseName }}" />
        </div>
        <div>
            <label for="">Description</label>
            <input type="text" name="CourseDescription" placeholder="description" value="{{ $course->CourseDescription }}" />
        </div>
        <div>
            <label for="">SKS amount</label>
            <input type="text" name="SKS" placeholder="sks" value="{{ $course->SKS }}" />
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>

@endsection
