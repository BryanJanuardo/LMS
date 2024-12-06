@extends('layout')

@section('title', 'Dashboard')
@push('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="heading-text">
        <h1>Dashboard</h1>
        <p style="font-size: 18px">Welcome back, {{Auth::user()->UserName}}!</p>
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
                </div>
            @endforeach
        </div>

    </div>
@endsection
