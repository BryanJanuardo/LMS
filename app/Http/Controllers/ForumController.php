<?php

namespace App\Http\Controllers;

use App\Events\NewAnnouncement;
use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $forumPosts = ForumPost::with('replies')->get();
        return view('components.forum', compact('forumPosts'));
    }

    public function store(Request $request, $CourseID, $SessionID)
    {
        // dd($request->file('FilePath'));
        $request->validate([
            'ForumTitle' => 'required|string|max:255|min:5',
            'ForumDescription' => 'required|string|max:1000|min:10',
            'FilePath' => 'nullable|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:2048',
        ]);

        $postId = (ForumPost::orderBy('id', 'desc')->first()->id) + 1;
        $File = null;

        if ($request->hasFile('FilePath')) {
            $extension = $request->file('FilePath')->getClientOriginalExtension();
            $File = 'Form_' .  $postId . '_User_' . (Auth::user()->id) . '.' . $extension;
            $request->file('FilePath')->move(public_path('storage/Forums'), $File);
        }

        $forum = ForumPost::create([
            'UserID' => Auth::user()->id,
            'SessionLearningID' => $SessionID,
            'ForumTitle' => $request->ForumTitle,
            'ForumDescription' => $request->ForumDescription,
            'CreatedDate' => now(),
            'FilePath' => $File,
        ]);

        $sessionLearning = $forum->sessionLearning;
        event(new NewAnnouncement($sessionLearning->courseLearning->id, "New Forum Posted! on Session: " . $sessionLearning->session->SessionName . " by " . Auth::user()->UserName));

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

    public function reply(Request $request, $CourseID, $SessionID, $postId)
    {
        $request->validate([
            'ReplyMessages' => 'required|string|max:1000|min:5',
            'FilePath' => 'nullable|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:2048',
        ]);

        $replyId = (ForumReply::orderBy('id', 'desc')->first()->id) + 1;
        $File = null;

        if ($request->hasFile('FilePath')) {
            $extension = $request->file('FilePath')->getClientOriginalExtension();
            $File = 'Form_' .  $postId .
            '_Reply_' . $replyId .
            '_User_' . (Auth::user()->id) . '.' . $extension;
            $request->file('FilePath')->move(public_path('Forums/Replies'), $File);
        }

        ForumReply::create([
            'UserID' => Auth::user()->id,
            'PostID' => $postId,
            'CreatedDate' => now(),
            'ReplyMessages' => $request->ReplyMessages,
            'FilePath' => $File,
        ]);

        return redirect()->back()->with('success', 'Reply posted successfully.');
    }

}
