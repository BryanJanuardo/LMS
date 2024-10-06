<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $primaryKey = 'SessionID';
    protected $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'SessionName',
        'SessionDescription',
    ];
}
