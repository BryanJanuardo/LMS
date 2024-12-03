<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLearning extends Model
{
    public function material()
    {
        return $this->hasOne(Material::class, 'MaterialID');
    }

    public function task()
    {
        return $this->hasOne(Task::class, 'TaskID');
    }
}
