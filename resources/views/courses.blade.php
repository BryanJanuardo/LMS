@extends('layout')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush
@section('content')
    <h1 style="margin-bottom: 16px;">My Courses</h1>
    @include('components.divider')
    <div id="courseList" class="course-container row">
        @foreach ($courses as $course)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->CourseName }}</h5>
                        <div class="course-details">
                            <div class="course-detail">
                                <i class="bi bi-person-badge-fill"></i>
                                <span class="course-code">{{ $course->CourseID }}</span>
                            </div>
                            <div class="course-detail">
                                <i class="bi bi-clipboard-check-fill"></i>
                                <span class="course-credits">{{ $course->SKS }}</span>
                            </div>
                            <div class="course-detail">
                                <i class="bi bi-people-fill"></i>
                                <span class="course-class">{{ $course->semester ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <a href="{{ route('course.detail', $course->CourseID) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
