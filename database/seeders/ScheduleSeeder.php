<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Announcement;
class ScheduleSeeder extends Seeder
{
    public function run()
    {
        // Create sample schedules
        $schedule1 = Schedule::create([
            'session_name' => 'Math 101',
            'session_description' => 'Introduction to basic mathematics.',
            'session_start' => '2024-12-01',
            'session_end' => '2024-12-10',
        ]);

        $schedule2 = Schedule::create([
            'session_name' => 'Science 101',
            'session_description' => 'Basic concepts of science.',
            'session_start' => '2024-12-15',
            'session_end' => '2024-12-20',
        ]);

        // Create sample announcements for schedule1
        Announcement::create([
            'schedule_id' => $schedule1->id,
            'title' => 'Important Update for Math 101',
            'message' => 'Please note that the session on 2024-12-05 has been rescheduled.',
            'announcement_date' => '2024-12-01',
        ]);

        // Create sample announcements for schedule2
        Announcement::create([
            'schedule_id' => $schedule2->id,
            'title' => 'Science 101: No Class on 2024-12-17',
            'message' => 'There will be no class on 2024-12-17 due to a faculty meeting.',
            'announcement_date' => '2024-12-01',
        ]);
    }
}
