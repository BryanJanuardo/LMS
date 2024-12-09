<?php

namespace App\Http\Controllers;

use App\Events\NewAnnouncement;
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

        $roleId = $roleId[0]->RoleID;
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

    public function edit($CourseID, $SessionID){
        $sessionLearning = SessionLearning::find($SessionID);
        return view('SessionEdit', ['CourseID' => $CourseID, 'session' => $sessionLearning->session]);
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

        $session = Session::create([
            'SessionID' => $newSessionID,
            'SessionName' => $data['SessionName'],
            'SessionDescription' => $data['SessionDescription'],
            'SessionStart' => $data['SessionStart'],
            'SessionEnd' => $data['SessionEnd'],
        ]);

        $sessionLearning = SessionLearning::create([
            'CourseLearningID' => $CourseID,
            'SessionID' => $newSessionID
        ]);

        event(new NewAnnouncement($CourseID, "New Session Added in" . $sessionLearning->courseLearning->course->CourseName));

        return redirect()->route('course.detail', ['CourseID' => $CourseID]);
    }

    public function update(Request $request, $CourseID, $SessionID){
        $data = $request->validate([
            'SessionName' => 'required',
            'SessionDescription' => 'required',
            'SessionStart' => 'required',
            'SessionEnd' => 'required',
        ]);

        $sessionLearning = SessionLearning::find($SessionID);
        $session = Session::where('SessionID', '=', $sessionLearning->session->SessionID)->get();
        if($session){
            $session->SessionName = $data['SessionName'];
            $session->SessionDescription = $data['SessionDescription'];
            $session->SessionStart = $data['SessionStart'];
            $session->SessionEnd = $data['SessionEnd'];
            $session->save();
            event(new NewAnnouncement($CourseID, "Session Updated in " . $session->sessionLearning->courseLearning->course->CourseName));
        }

        return redirect()->route('course.detail', ['CourseID' => $CourseID]);
    }

    public function delete($CourseID, $SessionID){
        $sessionLearning = SessionLearning::find($SessionID);
        $session = Session::where('SessionID', '=', $sessionLearning->session->SessionID)->firstOrFail();
        if($session){
            event(new NewAnnouncement($CourseID, "Session Deleted in" . $sessionLearning->courseLearning->course->CourseName));
            $session->delete();
        }
        return redirect()->route('course.detail', ['CourseID' => $CourseID]);
    }


    public function getSessionsByCourse($courseId)
    {
        $sessions = Session::where('course_id', $courseId)->get();
        return view('sessions.index', compact('sessions'));
    }

}
