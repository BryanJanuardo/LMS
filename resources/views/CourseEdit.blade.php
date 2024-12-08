@extends('layout')

@section('title', 'Edit Course')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Course</h1>

        <!-- Edit Course Form -->
        <form method="post" action="{{ route('course.update', ['CourseID' => $course->courseLearning->id]) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="CourseName" class="form-label">Course Name</label>
                <input type="text" name="CourseName" id="CourseName" class="form-control" placeholder="Enter course name" value="{{ old('CourseName', $course->course->CourseName) }}" required>
                @error('CourseName')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="CourseDescription" class="form-label">Course Description</label>
                <textarea name="CourseDescription" id="CourseDescription" class="form-control" placeholder="Enter course description" rows="4" required>{{ old('CourseDescription', $course->course->CourseDescription) }}</textarea>
                @error('CourseDescription')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="SKS" class="form-label">SKS Amount</label>
                <input type="number" name="SKS" id="SKS" class="form-control" placeholder="Enter SKS" value="{{ old('SKS', $course->course->SKS) }}" required>
                @error('SKS')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update Course</button>
            </div>
        </form>
    </div>
@endsection
