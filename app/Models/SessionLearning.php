<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionLearning extends Model
{
    use HasFactory;

    protected $table = 'session_learnings';

    protected $fillable = [
        'SessionID',
        'CourseLearningID',
    ];

    public function courseLearning(){
        return $this->belongsTo(CourseLearning::class, 'CourseLearningID');
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
        return $this->hasMany(ForumPost::class, 'SessionLearningID');
    }

    public function materialLearnings()
    {
        return $this->hasMany(MaterialLearning::class, 'SessionLearningID');
    }

    public function taskLearnings()
    {
        return $this->hasMany(TaskLearning::class, 'SessionLearningID');
    }
}
