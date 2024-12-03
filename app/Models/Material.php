<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public function materialLearning()
    {
        return $this->belongsTo(MaterialLearning::class, 'MaterialLearningID');
    }
}
