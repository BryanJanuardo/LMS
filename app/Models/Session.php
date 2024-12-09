<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessionses';
    protected $primaryKey = 'SessionID';
    protected $keyType = 'string';

    protected $fillable = [
        'SessionID',
        'SessionName',
        'SessionDescription',
        'SessionStart',
        'SessionEnd',
    ];

    public function sessionLearning()
    {
        return $this->hasOne(SessionLearning::class, 'SessionID');
    }
}
