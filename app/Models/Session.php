<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessionses';
    protected $primaryKey = 'SessionID';
    protected $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'SessionName',
        'SessionDescription',
        'SessionStart',
        'SessionEnd',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
