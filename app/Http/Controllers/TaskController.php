<?php

namespace App\Http\Controllers;

use App\Events\NewAnnouncement;
use App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Models\Task;
use App\Models\TaskLearning;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();

        return view('task', ['tasks' => $tasks]);
    }

    public function store(Request $request, $courseID, $sessionID){
        $data = $request->validate([
            'TaskName' => 'required',
            'TaskDesc' => 'required',
            'TaskDueDate' => 'required',
        ]);

        $task = Task::create([
            'TaskName' => $data['TaskName'],
            'TaskDesc' => $data['TaskDesc'],
            'TaskDueDate' => $data['TaskDueDate'],
        ]);

        $taskLearning = TaskLearning::create([
            'SessionLearningID' => $request->SessionID,
            'TaskID' => $task->TaskID,
            'TaskType' => $request->TaskType
        ]);

        event(new NewAnnouncement($courseID, "New Task Added! on Session: " . $taskLearning->sessionLearning->session->SessionName));

        return redirect($request->PreviousURL)->with('success', 'Task added successfully');
    }

    public function update(Request $request, $courseID, $sessionID){
        $data = $request->validate([
            'TaskName' => 'required',
            'TaskDesc' => 'required',
            'TaskDueDate' => 'required',
        ]);

        $task = Task::where('TaskID', $request->TaskID)->firstOrFail();

        if($task){
            $task->TaskName = $data['TaskName'];
            $task->TaskDesc = $data['TaskDesc'];
            $task->TaskDueDate = $data['TaskDueDate'];
            $task->save();
            event(new NewAnnouncement($courseID, "Task Updated! on Session: " . $task->taskLearning->sessionLearning->session->SessionName));
        }


        return redirect($request->PreviousURL)->with('success', 'Task saved successfully');
    }

    public function destroy(Request $request, $courseID, $sessionID){
        $task = Task::where('TaskID', $request->TaskID)->firstOrFail();
        if($task){
            event(new NewAnnouncement($courseID, "Task Deleted! on Session: " . $task->taskLearning->sessionLearning->session->SessionName));
            $task->delete();
        }

        return redirect($request->PreviousURL)->with('success', 'Task deleted successfully');
    }

    public function edit(Request $request, $TaskID){
        $task = Task::where('TaskID', $request->TaskID)->firstOrFail();

        return view('TaskEdit', ['task' => $task, 'CourseID' => $request->CourseID, 'SessionID' => $request->SessionID]);
    }

    public function add(Request $request){
        return view('TaskAdd', ['CourseID' => $request->CourseID, 'SessionID' => $request->SessionID, 'TaskType' => $request->TaskType]);
    }
}
