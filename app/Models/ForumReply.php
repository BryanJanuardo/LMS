<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'username', 'content'];

    public function post()
    {
        return $this->belongsTo(ForumPost::class, 'post_id');
    }
}
