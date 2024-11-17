<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'content'];
    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'post_id');
    }
}
