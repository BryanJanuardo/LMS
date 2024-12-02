{{--
@extends('layout')

@section('title', 'Course Details')

@push('styles')
    <link href="{{ asset('css/course-details.css') }}" rel="stylesheet">
@endpush

@php
    dd($sessionLearning);
@endphp

@section('content')
    <h1>{{ $course->course->CourseName }}</h1>
    <div class="course-info">
        <p><strong>Course Code:</strong> {{ $course->CourseID }}</p>
        <p><strong>Credits:</strong> {{ $course->course->SKS }}</p>
    </div>

    @include('components.divider')

    <div class="teacher-section" style="margin-bottom: 24px;">
        <div>
            <h5>John Doe, S.Kom., M.TI</h5>
            <p>Role: Instructor</p>
        </div>
    </div>

    <div class="tabs">
        <ul class="nav nav-tabs" id="sessionTabs" role="tablist">
            @foreach ($course->sessionLearnings as $key => $session)
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $key }}" data-bs-toggle="tab"
                        data-bs-target="#session-{{ $key }}" role="tab"
                        aria-controls="session-{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        Session {{ $loop->index + 1 }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content" id="sessionTabsContent">
            @foreach ($course->sessionLearnings as $key => $session)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="session-{{ $key }}"
                    role="tabpanel" aria-labelledby="tab-{{ $key }}">

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>{{ $session->SessionName }}</h5>
                            <p>{{ $session->SessionDescription }}</p>
                            <p><strong>Start:</strong>
                                {{ \Carbon\Carbon::parse($session->SessionStart)->format('M d, Y') }}</p>
                            <p><strong>End:</strong> {{ \Carbon\Carbon::parse($session->SessionEnd)->format('M d, Y') }}
                            </p>
                        </div>

                        @include('components.resources-card')
                    </div>

                </div>
            @endforeach
        </div>
        @include('components.forum', ['sessionLearning' => $course->sessionLearnings[0]])

    </div>

@endsection


@section('scripts')
    <script>
        document.querySelectorAll('.nav-link').forEach(function(tab) {
            tab.addEventListener('click', function(e) {
                console.log('Tab clicked:', e.target.id);
            });
        });
    </script>
@endsection --}}
{{-- @extends('layout')

@section('title', $course ? $course->course->CourseName ?? 'Course Details' : 'Course Details')

@section('content')
    @if ($course && $course->course)
        <h1>{{ $course->course->CourseName }}</h1>
        <p><strong>Course Code:</strong> {{ $course->CourseID }}</p>
        <p><strong>Credits:</strong> {{ $course->course->SKS }}</p>

        @foreach ($course->sessionLearnings ?? [] as $session)
            <div>
                <h3>{{ $session->SessionName }}</h3>
                <p>{{ $session->SessionDescription }}</p>
            </div>
        @endforeach
    @else
        <p>Course not found.</p>
    @endif
@endsection --}}

{{-- @extends('layout')

@section('title', 'Course Details')

@push('styles')
    <link href="{{ asset('css/course-details.css') }}" rel="stylesheet">
@endpush

@section('content')
    <h1>{{ $course->CourseName }}</h1>
    <div class="course-info">
        <p><strong>Course Code:</strong> {{ $course->CourseID }}</p>
        <p><strong>Credits:</strong> {{ $course->SKS }}</p>
    </div>

    @include('components.divider')

    <div class="teacher-section" style="margin-bottom: 24px;">
        <div>
            <h5>John Doe, S.Kom., M.TI</h5>
            <p>Role: Instructor</p>
        </div>
    </div>

    <div class="tabs">
        <ul class="nav nav-tabs" id="sessionTabs" role="tablist">
            @foreach ($course->sessionLearnings as $key => $session)
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $key }}" data-bs-toggle="tab"
                        data-bs-target="#session-{{ $key }}" role="tab"
                        aria-controls="session-{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        Session {{ $loop->index + 1 }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content" id="sessionTabsContent">
            @foreach ($course->sessionLearnings as $key => $session)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="session-{{ $key }}"
                    role="tabpanel" aria-labelledby="tab-{{ $key }}">

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>{{ $session->SessionName }}</h5>
                            <p>{{ $session->SessionDescription }}</p>
                            <p><strong>Start:</strong>
                                {{ \Carbon\Carbon::parse($session->SessionStart)->format('M d, Y') }}</p>
                            <p><strong>End:</strong> {{ \Carbon\Carbon::parse($session->SessionEnd)->format('M d, Y') }}
                            </p>
                        </div>

                        @include('components.resources-card')
                    </div>

                    <!-- Forum Section -->
                    @include('components.forum', ['sessionLearning' => $session])
                </div>
            @endforeach
        </div>
    </div>
@endsection --}}


{{-- @extends('layout')

@section('title', 'Course Details')

@push('styles')
    <link href="{{ asset('css/course-details.css') }}" rel="stylesheet">
@endpush

@section('content')
    @if ($course)
        <h1>{{ $course->course->CourseName }}</h1>
        <div class="course-info">
            <p><strong>Course Code:</strong> {{ $course->CourseID }}</p>
            <p><strong>Credits:</strong> {{ $course->course->SKS }}</p>
        </div>

        @include('components.divider')

        <div class="teacher-section" style="margin-bottom: 24px;">
            <div>
                <h5>John Doe, S.Kom., M.TI</h5>
                <p>Role: Instructor</p>
            </div>
        </div>

        <div class="tabs">
            <ul class="nav nav-tabs" id="sessionTabs" role="tablist">
                @foreach ($course->sessionLearnings as $key => $session)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $key }}" data-bs-toggle="tab"
                            data-bs-target="#session-{{ $key }}" role="tab"
                            aria-controls="session-{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            Session {{ $loop->index + 1 }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="sessionTabsContent">

                @foreach ($course->sessionLearnings as $key => $sessionLearning)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="session-{{ $key }}" role="tabpanel" aria-labelledby="tab-{{ $key }}">
                <div class="row mt-4">
                    <div class="col-md-6">
                        @if($sessionLearning->session) <!-- Check if the session exists -->
                            <h5>{{ $sessionLearning->session->SessionName }}</h5>
                            <p>{{ $sessionLearning->session->SessionDescription }}</p>
                            <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($sessionLearning->session->SessionStart)->format('M d, Y') }}</p>
                            <p><strong>End:</strong> {{ \Carbon\Carbon::parse($sessionLearning->session->SessionEnd)->format('M d, Y') }}</p>
                        @else
                            <p>No session information available.</p>
                        @endif
                    </div>

                    @include('components.resources-card')
                </div>
            </div>
        @endforeach

            </div>

            @include('components.forum', ['sessionLearning' => $course->sessionLearnings[0]])
        </div>

    @else
        <p>Course not found.</p>
    @endif
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.nav-link').forEach(function(tab) {
            tab.addEventListener('click', function(e) {
                console.log('Tab clicked:', e.target.id);
            });
        });
    </script>
@endsection --}}



@extends('layout')

@section('title', 'Course Details')

@push('styles')
    <link href="{{ asset('css/course-details.css') }}" rel="stylesheet">
@endpush

@section('content')
    @if ($course)
        <!-- Display Course Information -->
        <h1>{{ $course->CourseName }}</h1>
        <div class="course-info">
            <p><strong>Course Code:</strong> {{ $course->CourseID }}</p>
            <p><strong>Credits:</strong> {{ $course->SKS }}</p>
        </div>

        @include('components.divider')

        <!-- Teacher Information -->
        <div class="teacher-section" style="margin-bottom: 24px;">
            <div>
                <h5>John Doe, S.Kom., M.TI</h5>
                <p>Role: Instructor</p>
            </div>
        </div>

        <!-- Tabs for Sessions -->
        <div class="tabs">
            <ul class="nav nav-tabs" id="sessionTabs" role="tablist">
                @foreach ($course->sessionLearnings as $key => $sessionLearning)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $key }}" data-bs-toggle="tab"
                            data-bs-target="#session-{{ $key }}" role="tab"
                            aria-controls="session-{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            Session {{ $loop->index + 1 }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="sessionTabsContent">
                @foreach ($course->sessionLearnings as $key => $sessionLearning)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="session-{{ $key }}" role="tabpanel" aria-labelledby="tab-{{ $key }}">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                @if($sessionLearning->session) <!-- Check if the session exists -->
                                    <h5>{{ $sessionLearning->session->SessionName }}</h5>
                                    <p>{{ $sessionLearning->session->SessionDescription }}</p>
                                    <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($sessionLearning->session->SessionStart)->format('M d, Y') }}</p>
                                    <p><strong>End:</strong> {{ \Carbon\Carbon::parse($sessionLearning->session->SessionEnd)->format('M d, Y') }}</p>
                                @else
                                    <p>No session information available.</p>
                                @endif
                            </div>

                            @include('components.resources-card')
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Include Forum Section for the First Session -->
            @include('components.forum', ['sessionLearning' => $course->sessionLearnings[0]])
        </div>

    @else
        <p>Course not found.</p>
    @endif
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.nav-link').forEach(function(tab) {
            tab.addEventListener('click', function(e) {
                console.log('Tab clicked:', e.target.id);
            });
        });
    </script>
@endsection
