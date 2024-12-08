@extends('layout')

@section('title', 'Dashboard')

@push('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
@endpush

@section('content')
    <div class="heading-text mb-4">
        <h1 class="mb-4">Dashboard</h1>
        <p style="font-size: 18px">Welcome back, {{ Auth::user()->UserName }}!</p>
    </div>

    @include('components.divider')

    <style>
        .card-wrapper {
            margin-bottom: 30px;
        }

        .class-link {
            text-decoration: none;
            display: block;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .class-link:hover .course-block {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .course-block {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .class-name, .class-date, .class-time {
            margin: 5px 0;
        }
    </style>

    <div class="top-box">
        <div class="card-wrapper">
            <h3>Today's Classes</h3>
            @forelse ($todayCourses as $course)
                <a href="{{ route('course.detail', ['CourseID' => $course->id]) }}" class="class-link">
                    <div class="course-block">
                        <h5>{{ $course->CourseName }}</h5>
                        <p class="class-name">{{ $course->ClassName }}</p>
                        <p class="class-date">
                            <i class="bi bi-calendar-week-fill"></i>
                            {{ \Carbon\Carbon::parse($course->SessionStart)->toFormattedDateString() }}
                        </p>
                        <p class="class-time">
                            <i class="bi bi-clock-fill"></i>
                            {{ \Carbon\Carbon::parse($course->SessionStart)->format('H:i') }} - {{ \Carbon\Carbon::parse($course->SessionEnd)->format('H:i') }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="no-classes">No classes scheduled for today.</p>
            @endforelse
            {{ $todayCourses->links() }}
        </div>

        <div class="card-wrapper">
            {{-- <h3>Announcement</h3>
            @foreach ($announcements as $announcement)
                <div class="announcement-block">
                    <h5>{{ $announcement['title'] }}</h5>
                    <p class="announcement-content">{{ $announcement['content'] }}</p>

                </div>
            @endforeach --}}



            <h3 class="mb-4">Available Courses</h3>
            @if($availableCourses == null)
                <p>No available courses to display.</p>
            @else
                <div class="my-4">
                    <form class="form-inline" action="{{ route('dashboard.search') }}" method="GET">
                        <div class="input-group w-100 w-md-50 mx-auto">
                            <input class="form-control mr-sm-2 search-input" type="search" name="search" placeholder="Search for courses..." aria-label="Search" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary search-button" type="submit">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="flex-col">
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                        @foreach ($availableCourses as $index => $course)
                            <div class="col">
                                <div class="card shadow-sm border-0 rounded-lg clickable-card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="course-title mb-0">{{ $course->CourseName }} | {{ $course->ClassName }}</h5>
                                    </div>

                                    <div class="card-body">
                                        <p class="course-code mb-1"><strong>Instructor:</strong> {{ $course->UserName }}</p>
                                        <p class="course-user mb-1"><strong>Enrolled:</strong> {{ $course->TotalCountUserEnrolled }} Students</p>
                                        <p class="course-session mb-3"><strong>Sessions:</strong> {{ $course->TotalCountSessions }} Total Sessions</p>
                                        <p class="course-description" style="max-height: 60px; overflow: hidden;" id="desc-{{$index}}">
                                            {{ $course->CourseDescription }}
                                        </p>

                                        <button class="btn btn-link p-0"
                                        onclick="toggleDescription(this, '{{$index}}')">
                                            <p>Read More</p>
                                        </button>
                                    </div>
                                    <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                                        <span>Created at: {{ $course->created_at->format('d M Y') }} </span>
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"  data-bs-target="#enrollCourseModal" data-class-id="{{ $course->CourseLearningID }}" data-class-name="{{ $course->CourseName }}">Enroll</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $availableCourses->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="enrollCourseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
        <form id="enrollForm" method="POST" action="{{ route('course.enroll') }}">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="courseModalLabel">Join Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Do you want to join course <span id="modalCourseName"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="" id="modalCourseID" name="CourseLearningID">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Join</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleDescription(button, courseId) {
            console.log(courseId);
            var description = document.getElementById('desc-' + courseId);
            var button = event.target;
            console.log(description);

            if (description.style.maxHeight === 'none') {
                description.style.maxHeight = '60px';
                button.innerHTML = '<p>Read More</p>';
            } else {
                description.style.maxHeight = 'none';
                button.innerHTML = '<p>Read Less</p>';
            }
        }
        document.addEventListener('DOMContentLoaded', function () {

            const courseModal = document.getElementById('enrollCourseModal');
            courseModal.addEventListener('show.bs.modal', function (event) {
                const card = event.relatedTarget;
                const className = card.getAttribute('data-class-name');
                const modalCourseName = document.getElementById('modalCourseName');
                modalCourseName.textContent = className;
                const modalCourseID = document.getElementById('modalCourseID');
                modalCourseID.value = card.getAttribute('data-class-id');
                console.log(card.getAttribute('data-class-id'));
            });
        })
    </script>
@endpush
