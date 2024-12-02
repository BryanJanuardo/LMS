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
                                    @if($sessionLearning->session)
                                        <h5>{{ $sessionLearning->session->SessionName }}</h5>
                                        <p>{{ $sessionLearning->session->SessionDescription }}</p>
                                        <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($sessionLearning->session->SessionStart)->format('M d, Y') }}</p>
                                        <p><strong>End:</strong> {{ \Carbon\Carbon::parse($sessionLearning->session->SessionEnd)->format('M d, Y') }}</p>
                                    @else
                                        <p>No session information available.</p>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>Session Resources</h6>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="resourceTabs-{{ $key }}" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="materials-tab-{{ $key }}"
                                                        data-bs-toggle="tab" href="#materials-{{ $key }}" role="tab"
                                                        aria-controls="materials-{{ $key }}"
                                                        aria-selected="true">Materials</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="quiz-tab-{{ $key }}" data-bs-toggle="tab"
                                                        href="#quiz-{{ $key }}" role="tab"
                                                        aria-controls="quiz-{{ $key }}" aria-selected="false">Quiz</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="task-tab-{{ $key }}" data-bs-toggle="tab"
                                                        href="#task-{{ $key }}" role="tab"
                                                        aria-controls="task-{{ $key }}" aria-selected="false">Task</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content" id="resourceTabsContent-{{ $key }}">
                                                <!-- Materials Tab -->
                                                <div class="tab-pane fade show active" id="materials-{{ $key }}"
                                                    role="tabpanel" aria-labelledby="materials-tab-{{ $key }}">
                                                    <p class="mt-3">No materials available for this session.</p>
                                                </div>
                                                <!-- Quiz Tab -->
                                                <div class="tab-pane fade" id="quiz-{{ $key }}" role="tabpanel"
                                                    aria-labelledby="quiz-tab-{{ $key }}">
                                                    <p class="mt-3">No quiz available for this session.</p>
                                                </div>
                                                <!-- Task Tab -->
                                                <div class="tab-pane fade" id="task-{{ $key }}" role="tabpanel" aria-labelledby="task-tab-{{ $key }}">

                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

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
