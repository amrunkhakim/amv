<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    public $timestamps = false; // Only using created_at

    protected $fillable = [
        'ip_hash',
        'uri',
        'referer',
        'device',
        'platform',
        'browser',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
