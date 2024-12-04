<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $primaryKey = 'TaskID';
    protected $fillable = ['TaskName', 'TaskDesc', 'TaskDueDate'];

    public function taskLearning()
    {
        return $this->hasOne(TaskLearning::class);
    }
}
