<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\SessionLearning;
use Illuminate\Http\Request;

class SessionLearningController extends Controller
{
    public function index($SessionLearningID){
        $sessionLearning = SessionLearning::find($SessionLearningID);

        if (!$sessionLearning) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        return view('components.session-content')->with('sessionLearning', $sessionLearning);
    }
}
