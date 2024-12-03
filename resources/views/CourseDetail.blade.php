@extends('layout')

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

        <div class="tabs">
            <ul class="nav nav-tabs" id="sessionTabs" role="tablist">
                @foreach ($course->sessionLearnings as $key => $sessionLearning)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $key }}" data-bs-toggle="tab"
                            id="session-link"
                            data-url="{{ route('session.show', ['CourseID' => $course->id, 'SessionID' => $sessionLearning->id]) }}"
                            data-bs-target="#session-{{ $key }}" role="tab"
                            aria-controls="session-{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            Session {{ $loop->index + 1 }}
                        </a>
                    </li>
                @endforeach
            </ul>
            @if ($course->sessionLearnings)
                <div class="tab-content" id="sessionTabsContent">
                    @include('components.session-content', ['sessionLearning' => $course->sessionLearnings[0]])
                </div>
            @endif
        </div>

    @else
        <p>Course not found.</p>
    @endif
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('#sessionTabs .nav-link');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (event) {
            event.preventDefault();
            const url = this.getAttribute('data-url');

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#sessionTabsContent').innerHTML = html;
                })
                .catch(error => console.error('Error fetching session details:', error));
        });
    });
});
</script>
