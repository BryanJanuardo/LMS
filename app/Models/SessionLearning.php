<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionLearning extends Model
{
    use HasFactory;

    protected $table = 'session_learnings';

    public function courseLearning(){
        return $this->belongsTo(CourseLearning::class, 'id');
    }

    // public function tasks()
    // {
    //     return $this->belongsToMany(Task::class, 'TaskID');
    // }

    // public function session()
    // {
    //     return $this->belongsTo(Session::class, 'SessionID');
    // }

    // public function forumPosts()
    // {
    //     return $this->hasMany(ForumPost::class, 'id');
    // }
    public function session()
    {
        return $this->belongsTo(Session::class, 'SessionID'); // foreign key: 'SessionID'
    }

    // A SessionLearning has many Tasks through TaskID
    public function tasks()
    {
        return $this->hasMany(Task::class, 'TaskID'); // foreign key: 'TaskID' in session_learnings table
    }

    // A SessionLearning has many ForumPosts
    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class, 'SessionLearningID');
    }


    
}
