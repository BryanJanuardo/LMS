<div id="sessionDetails" class="row mt-4">
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
    @include('components.resources-card', ['key' => 3, 'sessionLearning' => $sessionLearning, 'roleId' => $roleId])
</div>

@include('components.forum', ['sessionLearning' => $sessionLearning])

