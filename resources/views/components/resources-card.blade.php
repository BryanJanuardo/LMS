<style>
    .text-wrap {
        white-space: normal;
        word-wrap: break-word;
        word-break: break-word;
        max-width: 200px;
    }
</style>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h6>Session Resources</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="resourceTabs-{{ $key }}" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="materials-tab-{{ $key }}" data-bs-toggle="tab" href="#materials-{{ $key }}" role="tab" aria-controls="materials-{{ $key }}" aria-selected="true">Materials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="quiz-tab-{{ $key }}" data-bs-toggle="tab" href="#quiz-{{ $key }}" role="tab" aria-controls="quiz-{{ $key }}" aria-selected="false">Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="task-tab-{{ $key }}" data-bs-toggle="tab" href="#task-{{ $key }}" role="tab" aria-controls="task-{{ $key }}" aria-selected="false">Task</a>
                </li>
            </ul>

            <div class="tab-content" id="resourceTabsContent-{{ $key }}">
                <!-- Materials Tab -->
                <div class="tab-pane fade show active" id="materials-{{ $key }}" role="tabpanel" aria-labelledby="materials-tab-{{ $key }}">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Material Name</th>
                                <th>Link</th>
                                <th>Type</th>
                                @if ($roleId == 1)
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="materialsTableBody">
                            @foreach ($sessionLearning->materialLearnings as $materialLearns)
                                <tr id="materialRow-{{ $materialLearns->id }}">
                                    <td>{{ $loop->iteration}}</td>
                                    <td class="text-wrap">{{ $materialLearns->material->MaterialName }}</td>
                                    <td><a href="{{ asset('/storage/Materials/' . basename($materialLearns->material->MaterialPath)) }}" download target="_blank">Link</a></td>
                                    <td class="text-wrap">{{ $materialLearns->material->MaterialType }}</td>
                                    @if($roleId == 1)
                                        <td>
                                            <a href="{{ route('material.edit', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'MaterialID' => $materialLearns->material->MaterialID]) }}" class="btn btn-secondary btn-sm">Edit</a>
                                            <form action="{{ route('material.destroy', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'MaterialID' => $materialLearns->material->MaterialID, 'PreviousURL' => URL::previous()]) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($roleId == 1)
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('material.add', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id]) }}" class="btn btn-primary"  data-bs-target="#materialModal">Add Material</a>
                        </div>
                    @endif
                </div>

                <!-- Quiz Tab -->
                <div class="tab-pane fade" id="quiz-{{ $key }}" role="tabpanel" aria-labelledby="quiz-tab-{{ $key }}">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Quiz Name</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                @if ($roleId == 1)
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="quizTableBody">
                            @foreach ($sessionLearning->taskLearnings->where('TaskType', 'Quiz') as $quizLearns)
                                <tr id="quizRow-{{ $quizLearns->id }}">
                                    <td>{{ $loop->iteration}}</td>
                                    <td class="text-wrap">{{ $quizLearns->task->TaskName }}</td>
                                    <td class="text-wrap">{{ $quizLearns->task->TaskDesc }}</td>
                                    <td>{{ $quizLearns->task->TaskDueDate }}</td>
                                    @if ($roleId == 1)
                                    <td>
                                        <a href="{{ route('task.edit', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskID' => $quizLearns->task->TaskID]) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        <form action="{{ route('task.destroy', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskID' => $quizLearns->task->TaskID, 'PreviousURL' => URL::previous()]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($roleId == 1)
                        <div class="d-flex justify-content-end mt-3">
                            <a class="btn btn-primary" href="{{ route('task.add', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskType' => 'Quiz']) }}" >Add Quiz</a>
                        </div>
                    @endif
                </div>

                <!-- Task Tab -->
                <div class="tab-pane fade" id="task-{{ $key }}" role="tabpanel" aria-labelledby="task-tab-{{ $key }}">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                @if ($roleId == 1)
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="taskTableBody">
                            @foreach ($sessionLearning->taskLearnings->where('TaskType', 'Assignment') as $taskLearns)
                                <tr id="taskRow-{{ $taskLearns->id }}">
                                    <td>{{ $loop->iteration}}</td>
                                    <td class="text-wrap">{{ $taskLearns->task->TaskName }}</td>
                                    <td class="text-wrap">{{ $taskLearns->task->TaskDesc }}</td>
                                    <td>{{ $taskLearns->task->TaskDueDate }}</td>
                                    @if ($roleId == 1)
                                    <td>
                                        <a href="{{ route('task.edit', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskID' => $taskLearns->task->TaskID]) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        <form action="{{ route('task.destroy', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskID' => $taskLearns->task->TaskID, 'PreviousURL' => URL::previous()]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($roleId == 1)
                        <div class="d-flex justify-content-end mt-3">
                            <a class="btn btn-primary" href="{{ route('task.add', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskType' => 'Assignment']) }}">Add Task</a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
