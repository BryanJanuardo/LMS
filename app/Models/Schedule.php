<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['session_name', 'session_description', 'session_start', 'session_end'];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
