
@extends('layout')

@section('title', 'Course Details')

@push('styles')
    <link href="{{ asset('css/course-details.css') }}" rel="stylesheet">
@endpush
@section('content')
    <h1>{{ $course->CourseName }}</h1>
    <div class="course-info">
        <p><strong>Course Code:</strong> {{ $course->CourseID }}</p>
        <p><strong>Credits:</strong> {{ $course->Credit }}</p>
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
            @foreach ($sessions as $key => $session)
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
            @foreach ($sessions as $key => $session)
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
    </div>

    @include('components.forum', ['forumPosts' => $forumPosts])
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
