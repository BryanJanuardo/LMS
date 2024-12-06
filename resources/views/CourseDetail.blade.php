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
                <li>
                    <a class="nav-link" id="add-session" href="{{ route('session.management', ['CourseID' => $course->id]) }}">
                        Add Session
                    </a>
                </li>
            </ul>
            @if ($course->sessionLearnings)
                <div class="tab-content" id="sessionTabsContent">
                </div>
            @endif
        </div>

    @else
        <p>Course not found.</p>
    @endif
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('#sessionTabs .nav-item a');
    const addSession = document.querySelector('#add-session');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (event) {
            event.preventDefault();
            const url = this.getAttribute('data-url');

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#sessionTabsContent').innerHTML = html;
                    initializeReplyButtons();
                })
                .catch(error => console.error('Error fetching session details:', error));
        });
    });

    function initializeReplyButtons() {
        const toggleButtons = document.querySelectorAll('#replyBtn');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const replyForm = this.closest('li').querySelector('.reply-form');
                replyForm.classList.toggle('hidden');
            });
        });

        const cancelButtons = document.querySelectorAll('.cancel-reply-btn');

        cancelButtons.forEach(button => {
            button.addEventListener('click', function () {
                const replyForm = this.closest('li').querySelector('.reply-form');
                replyForm.classList.add('hidden');
                replyForm.querySelector('textarea').value = '';
            });
        });
    }
    initializeReplyButtons();

    const firstTab = document.querySelector('#sessionTabs .nav-link.active');
    if (firstTab) {
        firstTab.click();
    }
});
</script>
