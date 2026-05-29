<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mou extends Model
{
    protected $table = 'mous';

    protected $fillable = [
        'user_id',
        'mou_number',
        'company_name',
        'client_name',
        'title',
        'content',
        'signature_data',
        'signature_date',
        'is_signed',
        'verification_token',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'signature_date' => 'datetime',
        'is_signed' => 'boolean',
    ];
}
