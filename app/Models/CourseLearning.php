<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLearning extends Model
{
    use HasFactory;

    protected $table = 'course_learnings';

    // public function course(){
    //     return $this->belongsTo(Course::class,  'CourseID', 'CourseID');
    // }

    public function course()
    {
        return $this->belongsTo(Course::class, 'CourseID'); // foreign key: 'CourseID'
    }

    // A CourseLearning belongs to a SessionLearning
    public function sessionLearning()
    {
        return $this->belongsTo(SessionLearning::class, 'SessionLearningID'); // foreign key: 'SessionLearningID'
    }

}
