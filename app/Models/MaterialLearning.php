<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialLearning extends Model
{
    use HasFactory;

    protected $primaryKey = 'MaterialLearningID';
    protected $fillable = ['MaterialID', 'TaskID', 'SessionLearningID'];

    public function material()
    {
        return $this->hasOne(Material::class, 'MaterialID');
    }
}
