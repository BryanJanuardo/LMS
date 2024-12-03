<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $table = 'user_courses';

    protected $fillable = [
        'UserID',
        'CourseLearningID',
        'RoleID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleID');
    }

    public function courseLearning()
    {
        return $this->belongsTo(CourseLearning::class, 'CourseLearningID');
    }
}
