<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Session;
use DateTime;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    const currentTimeZone = 'UTC';
    private function generateTimeZone(){
        $timeZone = new \DateTimeZone(self::currentTimeZone);
        $currDate = new \DateTime(now(), $timeZone);
        return $currDate;
    }
    public function index(){
        return view('CourseSession');
    }

    public function store(Request $request){
        $data = $request->validate([
            'SessionName' => 'required',
            'SessionDescription' => 'required',
        ]);

        Session::create([
            'SessionName' => $data['SessionName'],
            'SessionDescription' => $data['SessionDescription'],
            'SessionDate' => $this->generateTimeZone()->format('Y-m-d H:i:s'),
        ]);
        return redirect()->back();
    }

    public function update(Request $request, $SessionID){
        $data = $request->validate([
            'SessionName' => 'required',
            'SessionDescription' => 'required',
        ]);

        $session = Session::where('SessionID', '=', $SessionID)->firstOrFail();
        if($session){
            $session->SessionName = $data['SessionName'];
            $session->SessionDescription = $data['SessionDescription'];
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
