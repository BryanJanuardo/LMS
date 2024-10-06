<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $classes = [
            [
                'title' => 'Framework Layer Architecture',
                'session' => 'Session 1',
                'time' => '12:00 - 15:00 WIB',
            ],
            [
                'title' => 'Advanced PHP Techniques',
                'session' => 'Session 2',
                'time' => '10:00 - 12:00 WIB',
            ],
            [
                'title' => 'Introduction to Laravel',
                'session' => 'Session 3',
                'time' => '13:00 - 15:00 WIB',
            ],
            [
                'title' => 'JavaScript Fundamentals',
                'session' => 'Session 4',
                'time' => '09:00 - 11:00 WIB',
            ],
        ];

        $announcements = [
            [
                'title' => 'Open Enrollment SLC 2024',
                'content' => 'Informasi dikit tentang announcementnya',
            ],
            [
                'title' => 'Important Update on Course Materials',
                'content' => 'Please check the updated syllabus on the portal.',
            ],
            [
                'title' => 'Exam Schedule Released',
                'content' => 'The exam schedule has been posted on the notice board.',
            ],
            [
                'title' => 'Guest Lecture Next Week',
                'content' => 'Join us for a guest lecture on Cloud Computing.',
            ],
        ];

        $forums = [
            [
                'author' => 'Dosen 1',
                'posted_at' => '10:00 AM, 1 Oct 2024',
                'content' => 'Dear All, Silakan kirimkan output berupa SS NavBar Project kalian. Code tidak perlu. Notes: -Tugas ini dikerjakan secara personal',
            ],
            [
                'author' => 'Dosen 2',
                'posted_at' => '11:30 AM, 1 Oct 2024',
                'content' => 'Reminder: Submission deadline is this Friday. Don’t forget!',
            ],
            [
                'author' => 'Dosen 3',
                'posted_at' => '02:00 PM, 1 Oct 2024',
                'content' => 'Great job on the last assignment! Keep up the good work!',
            ],
            [
                'author' => 'Dosen 4',
                'posted_at' => '09:15 AM, 1 Oct 2024',
                'content' => 'Feel free to reach out if you have any questions about the project.',
            ],
        ];

        return view('dashboard', compact('classes', 'announcements', 'forums'));
    }
}
