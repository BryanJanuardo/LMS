@extends('layout')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')

<h1>Create a course</h1>
<form method="post" action="{{ route('course.store') }}">
    @csrf
    @method('POST')
    <div>
        <label for="">Name</label>
        <input type="name" name="CourseName" placeholder="name" />
    </div>
    <div>
        <label for="">Description</label>
        <input type="text" name="CourseDescription" placeholder="description" />
    </div>
    <div>
        <label for="">SKS amount</label>
        <input type="text" name="SKS" placeholder="sks" />
    </div>
    <div>
        <input type="submit" value="Submit">
    </div>
</form>

@endsection
