<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'CourseID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'CourseName',
        'CourseDescription',
        'SKS'
    ];

    public function courseLearnings()
    {
        return $this->hasMany(CourseLearning::class, 'CourseID'); // foreign key: 'CourseID'
    }

    // A Course has many SessionLearnings through CourseLearnings
    public function sessionLearnings()
    {
        return $this->hasManyThrough(
            SessionLearning::class,
            CourseLearning::class,
            'CourseID',            // foreign key on course_learnings table
            'id',                  // foreign key on session_learnings table
            'CourseID',            // local key on courses table
            'SessionLearningID'    // local key on course_learnings table
        );
    }


}
