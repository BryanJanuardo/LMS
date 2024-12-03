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
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#materialModal" onclick="editMaterial(1, 'Introduction to Topic', 'A brief overview of the topic.')">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteMaterial(1)">Delete</button>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materialModal" onclick="clearModal()">Add Material</button>
                    </div>
                </div>

                <div class="tab-pane fade" id="quiz-{{ $key }}" role="tabpanel" aria-labelledby="quiz-tab-{{ $key }}">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Quiz Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="quizTableBody">
                            <tr id="quizRow-1">
                                <td>1</td>
                                <td>Introduction Quiz</td>
                                <td>A quiz to test basic knowledge.</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#quizModal" onclick="editQuiz(1, 'Introduction Quiz', 'A quiz to test basic knowledge.')">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteQuiz(1)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quizModal" onclick="clearQuizModal()">Add Quiz</button>
                    </div>
                </div>

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
                            <tr id="taskRow-1">
                                <td>1</td>
                                <td>Complete Assignment</td>
                                <td>A task to complete the assignment.</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#taskModal" onclick="editTask(1, 'Complete Assignment', 'A task to complete the assignment.')">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTask(1)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal" onclick="clearTaskModal()">Add Task</button>
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
                        <label for="materialDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="materialDescription" rows="3" placeholder="Enter description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveMaterial()">Save</button>
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

<script>
    function clearModal() {
        document.getElementById('materialForm').reset();
    }
    function saveMaterial() {
        const name = document.getElementById('materialName').value;
        const description = document.getElementById('materialDescription').value;

        if (name && description) {
            alert('Material saved: ' + name);
        }
    }
    function editMaterial(id, name, description) {
        document.getElementById('materialName').value = name;
        document.getElementById('materialDescription').value = description;
    }
    function deleteMaterial(id) {
        if (confirm('Are you sure you want to delete this material?')) {
            alert('Material ' + id + ' deleted');
        }
    }
    function clearQuizModal() {
        document.getElementById('quizForm').reset();
    }
    function saveQuiz() {
        const name = document.getElementById('quizName').value;
        const description = document.getElementById('quizDescription').value;

        if (name && description) {
            alert('Quiz saved: ' + name);
        }
    }
    function editQuiz(id, name, description) {
        document.getElementById('quizName').value = name;
        document.getElementById('quizDescription').value = description;
    }
    function deleteQuiz(id) {
        if (confirm('Are you sure you want to delete this quiz?')) {
            alert('Quiz ' + id + ' deleted');
        }
    }
    function clearTaskModal() {
        document.getElementById('taskForm').reset();
    }

    function saveTask() {
        const name = document.getElementById('taskName').value;
        const description = document.getElementById('taskDescription').value;

        if (name && description) {
            alert('Task saved: ' + name);
        }
    }
    function editTask(id, name, description) {
        document.getElementById('taskName').value = name;
        document.getElementById('taskDescription').value = description;
    }
    function deleteTask(id) {
        if (confirm('Are you sure you want to delete this task?')) {
            alert('Task ' + id + ' deleted');
        }
    }
</script>
