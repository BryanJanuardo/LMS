<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(){
        return view('CourseSession');
    }

    public function store(Request $request){
        $data = $request->validate([
            'SessionName' => 'required',
            'SessionDescription' => 'required',
            'SessionStart' => 'required',
            'SessionEnd' => 'required',
        ]);

        Session::create([
            'SessionName' => $data['SessionName'],
            'SessionDescription' => $data['SessionDescription'],
            'SessionStart' => $data['SessionStart'],
            'SessionEnd' => $data['SessionEnd'],
        ]);
        return redirect()->back();
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
}
