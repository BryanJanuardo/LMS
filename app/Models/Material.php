<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $primaryKey = 'MaterialID';
    protected $fillable = ['MaterialName', 'MaterialType', 'MaterialPath'];

    public function materialLearning()
    {
        return $this->hasOne(MaterialLearning::class);
    }
}
