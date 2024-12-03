<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        dd($tasks);
        return view('CourseDetail', compact('tasks'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'TaskName' => 'required',
            'TaskDesc' => 'required',
            'TaskType' => 'required',
            'TaskDueDate' => 'required',
        ]);

        Task::create([
            'TaskName' => $data['TaskName'],
            'TaskDesc' => $data['TaskDesc'],
            'TaskType' => $data['TaskType'],
            'TaskDueDate' => $data['TaskDueDate'],
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $TaskID){
        $data = $request->validate([
            'TaskName' => 'required',
            'TaskDesc' => 'required',
            'TaskType' => 'required',
            'TaskDueDate' => 'required',
        ]);

        $task = Task::find($TaskID)->firstOrFail();

        if($task){
            $task->TaskName = $data['TaskName'];
            $task->TaskDesc = $data['TaskDesc'];
            $task->TaskType = $data['TaskType'];
            $task->TaskDueDate = $data['TaskDueDate'];
            $task->save();
        }

        return redirect()->back();
    }

    public function delete($TaskID){
        $task = Task::find($TaskID)->firstOrFail();
        if($task){
            $task->delete();
        }
        return redirect()->back();
    }

    public function getTasksByDate($date)
    {
        // Assuming 'TaskDueDate' is the name of the field in your database
        $tasks = Task::where('TaskDueDate', $date)->get();
        return response()->json($tasks);
    }

}
