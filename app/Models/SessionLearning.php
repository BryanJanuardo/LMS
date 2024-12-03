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

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'TaskID');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'SessionID');
    }

    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class, 'id');
    }

    public function materialLearning()
    {
        return $this->hasMany(MaterialLearning::class, 'MaterialLearningID');
    }

    public function taskLearning()
    {
        return $this->hasMany(TaskLearning::class, 'TaskLearningID');
    }
}
