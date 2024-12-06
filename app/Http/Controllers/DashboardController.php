<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseLearning;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = CourseLearning::query()
            ->leftJoin('user_courses', 'course_learnings.id', '=', 'user_courses.CourseLearningID')
            ->where(function ($query) {
                $query->whereNull('user_courses.UserID')
                      ->orWhere('user_courses.UserID', '!=', Auth::id());
            })
            ->select('course_learnings.*')
            ->distinct()
            ->get();

        return view('dashboard', compact('courses'));
        // $announcements = [
        //     [
        //         'title' => 'Open Enrollment SLC 2024',
        //         'content' => 'Informasi dikit tentang announcementnya',
        //     ],
        //     [
        //         'title' => 'Important Update on Course Materials',
        //         'content' => 'Please check the updated syllabus on the portal.',
        //     ],
        //     [
        //         'title' => 'Exam Schedule Released',
        //         'content' => 'The exam schedule has been posted on the notice board.',
        //     ],
        //     [
        //         'title' => 'Guest Lecture Next Week',
        //         'content' => 'Join us for a guest lecture on Cloud Computing.',
        //     ],
        // ];

        // $forums = [
        //     [
        //         'author' => 'Dosen 1',
        //         'posted_at' => '10:00 AM, 1 Oct 2024',
        //         'content' => 'Dear All, Silakan kirimkan output berupa SS NavBar Project kalian. Code tidak perlu. Notes: -Tugas ini dikerjakan secara personal',
        //     ],
        //     [
        //         'author' => 'Dosen 2',
        //         'posted_at' => '11:30 AM, 1 Oct 2024',
        //         'content' => 'Reminder: Submission deadline is this Friday. Don’t forget!',
        //     ],
        //     [
        //         'author' => 'Dosen 3',
        //         'posted_at' => '02:00 PM, 1 Oct 2024',
        //         'content' => 'Great job on the last assignment! Keep up the good work!',
        //     ],
        //     [
        //         'author' => 'Dosen 4',
        //         'posted_at' => '09:15 AM, 1 Oct 2024',
        //         'content' => 'Feel free to reach out if you have any questions about the project.',
        //     ],
        // ];

        // return view('dashboard', compact('classes', 'announcements', 'forums'));
    }

    // app/Http/Controllers/DashboardController.php
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');  // Get the search term from the form

        // Fetch courses with the search term
        $courses = CourseLearning::query()
            ->leftJoin('user_courses', 'course_learnings.id', '=', 'user_courses.CourseLearningID')
            ->where(function ($query) {
                $query->whereNull('user_courses.UserID')
                    ->orWhere('user_courses.UserID', '!=', Auth::id());
            })
            ->where('course_learnings.ClassName', 'like', '%' . $searchTerm . '%') // Filter by search term
            ->select('course_learnings.*')
            ->distinct()
            ->get();

        return view('dashboard', compact('courses'));
    }

}
