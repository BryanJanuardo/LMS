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
                    {{-- @foreach ($sessionLearning->materialLearnings as $materialLearns)
                        @if ($materialLearns)
                            @php
                                $material = $materialLearns->material;
                            @endphp
                            @if ($material)
                                <p class="mt-3">{{$material->MaterialName}}</p>
                            @else
                                <p class="mt-3">No material available for this session.</p>
                            @endif
                            @else
                                <p class="mt-3">No materialLearns available for this session.</p>
                        @endif
                    @endforeach --}}
                    @foreach ($sessionLearning->materialLearnings as $materialLearns)
                        {{-- @foreach ($materialLearns->material as $material )
                        <strong>{{ $material->MaterialName }}:</strong>
                        <p>{{ $material->MaterialType }}</p>
                        @endforeach --}}
                        <strong>{{ $materialLearns->material->MaterialName }}:</strong>
                        <p>{{ $materialLearns->material->MaterialType }}</p>
                    @endforeach
                </div>
                <!-- Quiz Tab -->
                <div class="tab-pane fade" id="quiz-{{ $key }}" role="tabpanel"
                    aria-labelledby="quiz-tab-{{ $key }}">
                    <p class="mt-3">No quiz available for this session.</p>
                </div>
                <!-- Task Tab -->
                <div class="tab-pane fade" id="task-{{ $key }}" role="tabpanel"
                    aria-labelledby="task-tab-{{ $key }}">
                    <p class="mt-3">No tasks available for this session.</p>
                </div>
            </div>
        </div>
    </div>
</div>


