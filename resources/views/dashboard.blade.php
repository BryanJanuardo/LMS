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

    <div class="top-box">
        <div class="card-wrapper">
            <h3>Today Classes</h3>
            @foreach ($classes as $class)
                <div class="course-block">
                    <h5>{{ $class['title'] }}</h5>
                    <p>{{ $class['session'] }}</p>
                    <p>
                        <i class="bi bi-clock-fill"></i>
                        {{ $class['time'] }}
                    </p>
                </div>
            @endforeach
        </div>


        <div class="card-wrapper">
            <h3>Forum</h3>
            @foreach ($forums as $forum)
                <div class="forum-block">
                    <div class="forum-header">
                        <i class="bi bi-person-fill" style="margin-right:12px; font-size: 48px"></i>
                        <div class="forum-details">
                            <h5>{{ $forum['author'] }}</h5>
                            <p class="time-posted">Posted at {{ $forum['posted_at'] }}</p>
                        </div>
                    </div>

                    <p class="forum-content">{{ $forum['content'] }}</p>

                    @include('components.divider')
                </div>
            @endforeach
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
