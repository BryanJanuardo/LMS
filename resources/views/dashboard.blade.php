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
    <form class="form-inline my-2 my-lg-0 mb-4" action="{{ route('dashboard.search') }}" method="GET">
        <div class="input-group w-100 w-md-50 mx-auto">
            <input class="form-control mr-sm-2 search-input" type="search" name="search" placeholder="Search for courses..." aria-label="Search" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-primary search-button" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </div>
    </form>

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
            @forelse ($classes as $class)
                <a href="{{ route('course.detail', ['CourseID' => $class->id]) }}" class="class-link">
                    <div class="course-block">
                        <h5>{{ $class->CourseName }}</h5>
                        <p class="class-name">{{ $class->ClassName }}</p>
                        <p class="class-date">
                            <i class="bi bi-calendar-week-fill"></i>
                            {{ \Carbon\Carbon::parse($class->SessionStart)->toFormattedDateString() }}
                        </p>
                        <p class="class-time">
                            <i class="bi bi-clock-fill"></i>
                            {{ \Carbon\Carbon::parse($class->SessionStart)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->SessionEnd)->format('H:i') }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="no-classes">No classes scheduled for today.</p>
            @endforelse
        </div>

        <div class="card-wrapper">
            <h3>Announcement</h3>
            @foreach ($announcements as $announcement)
                <div class="announcement-block">
                    <h5>{{ $announcement['title'] }}</h5>
                    <p class="announcement-content">{{ $announcement['content'] }}</p>
            <h3 class="mb-4">Available Courses</h3>
            @if($courses->isEmpty())
                <p>No available courses to display.</p>
            @else
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4">
                    @foreach ($courses as $course)
                        <div class="col mb-4">
                            <div class="card shadow-sm fixed-card clickable-card" data-bs-toggle="modal" data-bs-target="#courseModal" data-class-name="{{ $course->ClassName }}">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="course-title mb-0">{{ $course->ClassName }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="course-description">{{ $course->description }}</p>
                                </div>
                                <div class="card-footer text-muted">
                                    Created at: {{ $course->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courseModalLabel">Join Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to join the course: <span id="modalCourseName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Join</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const courseModal = document.getElementById('courseModal');
        courseModal.addEventListener('show.bs.modal', function (event) {
            const card = event.relatedTarget;
            const className = card.getAttribute('data-class-name');
            const modalCourseName = document.getElementById('modalCourseName');
            modalCourseName.textContent = className;
        });
    </script>
@endpush
