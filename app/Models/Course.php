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
        'CourseID',
        'CourseName',
        'CourseDescription',
        'SKS'
    ];

}
