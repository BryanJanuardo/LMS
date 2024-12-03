<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLearning extends Model
{
    use HasFactory;

    protected $table = 'course_learnings';

    public function course(){
        return $this->belongsTo(Course::class,  'CourseID', 'CourseID');
    }

    public function sessionLearnings(){
        return $this->hasMany(SessionLearning::class, 'CourseLearningID', 'id');
    }

    public function userCourses(){
        return $this->hasMany(UserCourse::class, 'CourseLearningID', 'id');
    }
}
