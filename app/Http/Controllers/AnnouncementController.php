<?php

namespace App\Http\Controllers;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function store(Request $request)
{
    $announcement = Announcement::create([
        'schedule_id' => $request->schedule_id,
        'message' => $request->message,
    ]);

    return response()->json($announcement);
}

}
