@extends('layout')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container">
    <h1 class="mb-4 text-center">My Courses</h1>
    @include('components.divider')
    <div id="courseList" class="row g-4">
        @foreach ($courses as $course)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center">{{ $course->courseLearning->course->CourseName }}</h5>
                        <div class="course-details mt-3 d-flex gap-2 justify-content-center">
                            <div class="course-detail d-flex align-items-center mb-2">
                                <i class="bi bi-person-badge-fill me-2"></i>
                                <span class="course-code">{{ $course->courseLearning->ClassName }}</span>
                            </div>
                            <div class="course-detail d-flex align-items-center mb-2">
                                <i class="bi bi-clipboard-check-fill me-2"></i>
                                <span class="course-credits">{{ $course->courseLearning->course->SKS }}</span>
                            </div>
                            <div class="course-detail d-flex align-items-center">
                                <i class="bi bi-people-fill me-2"></i>
                                <span class="course-class">{{ $course->semester ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <a href="{{ route('course.detail', ['CourseID' => $course->courseLearning->id]) }}"
                        class="btn btn-primary mt-auto align-self-center">
                        View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
