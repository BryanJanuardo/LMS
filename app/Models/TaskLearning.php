<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLearning extends Model
{
    use HasFactory;

    protected $primaryKey = 'TaskLearningID';
    protected $fillable = ['TaskID', 'SessionLearningID', 'TaskType'];

    public function task()
    {

        return $this->belongsTo(Task::class, 'TaskID');
    }

    public function sessionLearning(){
        return $this->belongsTo(SessionLearning::class, 'id');
    }

}
