<?php

namespace App\Http\Controllers;
use App\Models\SessionLearning;
use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function showForum($CourseID, $SessionID)
    {
        $sessionLearning = SessionLearning::with('courseLearning', 'forumPosts.replies') // Load relationships
            ->where('id', $SessionID)
            ->first();

        if (!$sessionLearning) {
            abort(404, 'Session Learning not found.');
        }

        return view('components.forum', compact('sessionLearning'));
    }

    public function index(Request $request)
    {
        $forumPosts = ForumPost::with('replies')->get();
        return view('components.forum', compact('forumPosts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        ForumPost::create([
            'username' => 'UserTest',
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }
    public function reply(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        ForumReply::create([
            'post_id' => $postId,
            'username' => 'UserTest',
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Reply posted successfully.');
    }

}
