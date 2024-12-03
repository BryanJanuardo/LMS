<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    protected $table = 'forum_posts';

    protected $fillable = [
        'UserID',
        'SessionLearningID',
        'ForumTitle',
        'ForumDescription',
        'CreatedDate',
        'FilePath'
    ];

    public function sessionLearning(){
        return $this->belongsTo(SessionLearning::class, 'id');
    }

    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'PostID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
