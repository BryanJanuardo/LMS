@extends('layout')

@section('title', 'Create a Course')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Create a New Course</h1>

        <!-- Form to Create a New Course -->
        <form method="post" action="{{ route('course.store') }}">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="CourseName" class="form-label">Course Name</label>
                <input type="text" name="CourseName" id="CourseName" class="form-control" placeholder="Enter course name" value="{{ old('CourseName') }}" required>
                @error('CourseName')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="CourseDescription" class="form-label">Course Description</label>
                <textarea name="CourseDescription" id="CourseDescription" class="form-control" placeholder="Enter course description" rows="4" required>{{ old('CourseDescription') }}</textarea>
                @error('CourseDescription')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="SKS" class="form-label">SKS Amount</label>
                <input type="number" name="SKS" id="SKS" class="form-control" placeholder="Enter SKS" value="{{ old('SKS') }}" required>
                @error('SKS')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
