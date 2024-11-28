<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'content'];

    public function sessionLearning(){
        return $this->belongsTo(SessionLearning::class, 'id');
    }

    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'id');
    }
}
