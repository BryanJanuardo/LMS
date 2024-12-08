<?php

namespace App\Listeners;

use App\Events\NewAnnouncement;
use App\Models\Announcement;
use App\Models\UserCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SendAnnouncement
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewAnnouncement $event): void
    {
        $users = UserCourse::where('CourseLearningID', $event->courseLearningId)
        ->where('UserID', '!=', Auth::user()->id)
        ->get();

        foreach ($users as $user) {
            Announcement::create([
                'UserID' => $user->UserID,
                'AnnouncementMessage' => $event->announcement
            ]);
        }
    }
}
