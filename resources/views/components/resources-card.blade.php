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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="materialsTableBody">
                            @foreach ($sessionLearning->materialLearnings as $materialLearns)
                                <tr id="materialRow-{{ $materialLearns->id }}">
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $materialLearns->material->MaterialName }}</td>
                                    <td>{{ $materialLearns->material->MaterialPath }}</td>
                                    <td>{{ $materialLearns->material->MaterialType }}</td>
                                    <td>
                                        <a href="{{ route('material.edit', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'MaterialID' => $materialLearns->material->MaterialID]) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        <form action="{{ route('material.destroy', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'MaterialID' => $materialLearns->material->MaterialID]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materialModal">Add Material</button>
                    </div>
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="quizTableBody">
                            @foreach ($sessionLearning->taskLearnings->where('TaskType', 'Quiz') as $quizLearns)
                                <tr id="quizRow-{{ $quizLearns->id }}">
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $quizLearns->task->TaskName }}</td>
                                    <td>{{ $quizLearns->task->TaskDesc }}</td>
                                    <td>{{ $quizLearns->task->TaskDueDate }}</td>
                                    <td>
                                        <a href="{{ route('task.edit', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskID' => $quizLearns->task->TaskID]) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        <form action="{{ route('task.destroy', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskID' => $quizLearns->task->TaskID]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quizModal">Add Quiz</button>
                    </div>
                </div>

                <!-- Task Tab -->
                <div class="tab-pane fade" id="task-{{ $key }}" role="tabpanel" aria-labelledby="task-tab-{{ $key }}">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="taskTableBody">
                            @foreach ($sessionLearning->taskLearnings->where('TaskType', 'Assignment') as $taskLearns)
                                <tr id="taskRow-{{ $taskLearns->id }}">
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $taskLearns->task->TaskName }}</td>
                                    <td>{{ $taskLearns->task->TaskDesc }}</td>
                                    <td>
                                        <a href="{{ route('task.edit', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskID' => $taskLearns->task->TaskID]) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        <form action="{{ route('task.destroy', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'TaskID' => $taskLearns->task->TaskID]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">Add Task</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="materialModal" tabindex="-1" aria-labelledby="materialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="materialModalLabel">Add/Edit Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="materialForm">
                    <div class="mb-3">
                        <label for="materialName" class="form-label">Material Name</label>
                        <input type="text" class="form-control" id="materialName" placeholder="Enter material name">
                    </div>
                    <div class="mb-3">
                        <label for="materialType" class="form-label">Material Type</label>
                        <textarea class="form-control" id="materialDescription" rows="3" placeholder="Enter material type"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="materialPath" class="form-label">Material Path</label>
                        <textarea class="form-control" id="materialDescription" rows="3" placeholder="Enter material path"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveMaterialBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quizModalLabel">Add/Edit Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="quizForm">
                    <div class="mb-3">
                        <label for="quizName" class="form-label">Quiz Name</label>
                        <input type="text" class="form-control" id="quizName" placeholder="Enter quiz name">
                    </div>
                    <div class="mb-3">
                        <label for="quizDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="quizDescription" rows="3" placeholder="Enter description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveQuiz()">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Add/Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="taskName" placeholder="Enter task name">
                    </div>
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="taskDescription" rows="3" placeholder="Enter description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveTask()">Save</button>
            </div>
        </div>
    </div>
</div>
