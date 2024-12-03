<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;

    protected $table = 'forum_replies';

    protected $fillable = [
        'UserID',
        'PostID',
        'CreatedDate',
        'ReplyMessages',
        'FilePath'
    ];

    public function post()
    {
        return $this->belongsTo(ForumPost::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
