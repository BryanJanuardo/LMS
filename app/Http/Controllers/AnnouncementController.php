<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function markRead($announcementId) {
        $announcement = Announcement::find($announcementId);
        $announcement->delete();

        return response()->json(['status' => 'success']);
    }

}
