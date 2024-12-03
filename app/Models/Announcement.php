<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = ['schedule_id', 'title', 'message', 'announcement_date'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
