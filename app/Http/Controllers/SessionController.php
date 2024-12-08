<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Session;
use App\Models\SessionLearning;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create($courseID){
        return view('SessionCreate')->with('courseID', $courseID);
    }

    public function index($CourseID, $SessionID)
    {
        $sessionLearning = SessionLearning::find($SessionID);
        $roleId = UserCourse::where('UserID', Auth::user()->id)
        ->where('CourseLearningID', $CourseID)
        ->get();
        // dd($roleId[0]->RoleID);
        $roleId = $roleId[0]->RoleID;
        // dd($roleId);
        return view('components.session-content')->with(['sessionLearning' => $sessionLearning, 'roleId' => $roleId]);
    }

    public function course(){
        $userId = Auth::user()->id;
        $courses = UserCourse::where('UserID', '=', $userId)
        ->where('RoleID', '=', 1)
        ->get();

        return view('CourseSessions', ['courses' => $courses]);
    }

    public function manage($courseID){
        $sessions = SessionLearning::where('CourseLearningID', '=', $courseID)->get();
        return view('SessionsManagement', ['sessionLearnings' => $sessions, 'courseID' => $courseID]);
    }

    public function store(Request $request, $CourseID){
        $data = $request->validate([
            'SessionName' => 'required',
            'SessionDescription' => 'required',
            'SessionStart' => 'required',
            'SessionEnd' => 'required',
        ]);

        $latestSession = Session::latest('SessionID')->first();
        $latestSessionID = $latestSession ? substr($latestSession->SessionID, 1) : 0;
        $newSessionID = 'S' . str_pad((intval($latestSessionID) + 1), 8, '0', STR_PAD_LEFT);

        // dd($newSessionID);

        $session = Session::create([
            'SessionID' => $newSessionID,
            'SessionName' => $data['SessionName'],
            'SessionDescription' => $data['SessionDescription'],
            'SessionStart' => $data['SessionStart'],
            'SessionEnd' => $data['SessionEnd'],
        ]);

        SessionLearning::create([
            'CourseLearningID' => $CourseID,
            'SessionID' => $newSessionID
        ]);

        return redirect()->route('course.detail', ['courseId' => $CourseID]);
    }

    public function update(Request $request, $SessionID){
        $data = $request->validate([
            'SessionName' => 'required',
            'SessionDescription' => 'required',
            'SessionStart' => 'required',
            'SessionEnd' => 'required',
        ]);

        $session = Session::where('SessionID', '=', $SessionID)->firstOrFail();
        if($session){
            $session->SessionName = $data['SessionName'];
            $session->SessionDescription = $data['SessionDescription'];
            $session->SessionStart = $data['SessionStart'];
            $session->SessionEnd = $data['SessionEnd'];
            $session->save();
        }
        return redirect()->back();
    }

    public function delete($SessionID){
        $session = Session::where('SessionID', '=', $SessionID)->firstOrFail();
        if($session){
            $session->delete();
        }
        return redirect()->back();
    }


    public function getSessionsByCourse($courseId)
    {
        $sessions = Session::where('course_id', $courseId)->get();
        return view('sessions.index', compact('sessions'));
    }

}
