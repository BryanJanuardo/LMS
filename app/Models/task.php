<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'TaskName',
        'TaskDesc',
        'TaskType',
        'TaskDueDate',
    ];

    public function sessionLearnings()
    {
        return $this->hasMany(SessionLearning::class, 'TaskID'); // foreign key: 'TaskID'
    }
}
